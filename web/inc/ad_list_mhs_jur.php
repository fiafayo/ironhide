<?
	$memberJur = getDetailMember($_SESSION['paj_id']);
	$jur = $memberJur['kode_jur'];
	
	if($_GET['cari'])	{
		$cmhs = $_GET['cmhs'];
		$cjur = $_GET['cjur'];
		$cang = $_GET['cang'];
	}
	
	if($_POST['cmdUbah'])	{
		$minat = $_POST['cbMinat'];
		$jurusan  = $_POST['slcMinat'];
		if($minat && $jurusan!='0')	{
			foreach($minat as $ubah)	{
				$result = editJurMhs($jurusan,$ubah);
				$nama = $nama." ".$ubah;
			}
			if($result) 	{
				$inf = " Jurusan mahasiswa ".$nama." telah berhasil diubah";
			}
			else	{
				$error = " Jurusan mahasiswa gagal diubah";
			}
		}
		else	{
			$error = "Pengisian data kurang lengkap";
		}
	}
?>

<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3" class="subHeaderMenu">Daftar Mahasiswa Penjurusan </td>
  </tr>
  <tr align="center">
    <td colspan="3"><?
			if($error)
			{
				echo "<div class='warning'>".$error."</div>";
			}
			elseif($inf)
			{
				echo "<div class='information'>".$inf."</div>";
			}
		?></td>
  </tr>
  <form name="frmMahasiswa" method="get">
  <tr>
    <td colspan="2" align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="right">Cari berdasarkan Nama / Nrp : </td>
    <td><input type="text" name="cmhs" value="<? echo $cmhs; ?>" class="stext"></td>
  </tr>
  <tr>
    <td colspan="2" align="right">Jurusan : </td>
    <td><select name="cjur" class="stext">
      <option value="">- Pilih Jurusan -</option>
      <?
						$piljur = getMinat($jur);
						foreach($piljur as $display)	{
							if($cjur==$display['kode_jur'])	{	
								echo "<option value='".$display['kode_jur']."' selected>".$display['nama']."</option>";
							}
							else	{
								echo "<option value='".$display['kode_jur']."'>".$display['nama']."</option>";
							}
						}
					?>
    </select></td>
  </tr>
  <tr>
    <td colspan="2" align="right">Angkatan : </td>
    <td><input name="cang" type="text" class="stext" value="<? echo $cang; ?>" size="4" maxlength="4"></td>
  </tr>
  <tr>
    <td colspan="2" align="right">&nbsp; </td>
    <td width="248"> <input type="submit" name="cari" value=" Cari " class="sbutton"></td>
  </tr>
  </form>
  <form name="frmMahasiswaMinat" method="post" >
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><div class="listTable">
        <table width="488" border="0" cellspacing="0" cellpadding="0">
          <tr class="headerTable">
            <td width="26" nowrap>No</td>
            <td width="20" nowrap>&nbsp;</td>
            <td width="55" nowrap>Nrp</td>
            <td width="202" nowrap>Nama</td>
            <td width="185" nowrap>Jurusan</td>
            </tr>
          <?
		  	if($_GET['page']) {
				$page = $_GET['page']-1;
			}
			else {
				$page = 0;
			}
			
	  		$pages = ($page)*LM_DISPLAY;
	  		$mhs = searchMhsMinat($cmhs,$cjur,$cang,$pages,$jur);
			if($mhs)	{
				$i=$pages;
				foreach($mhs as $display)	{
				$i++;
	  ?>		
          <tr>
            <td align="center"><? echo $i;?></td>
            <td align="center"><input type="checkbox" name="cbMinat[]" value="<? echo $display['nrp']; ?>"></td>
            <td align="center"><? echo $display['nrp'];?></td>
            <td><a href="master_minat.php?nrp=<? echo $display['nrp']; ?>&minat=1"><? echo $display['nama'];?></a>&nbsp;</td>
            <td align="center"><? $jurLain = getDetailJurusan($display['jurusan']);
			echo $jurLain['nama'];
			?>              </td>
            </tr>
          <?
	  			}
	  		}
			else	{
			?>
          <tr>
            <td colspan="5" align="center">Tidak ada data mahasiswa</td>
          </tr>
          <?
			}
	  ?>
          <tr>
            <td colspan="5" align="center"><? 
			if(($_GET['page']!=1)&&(($_GET['page'])))	{
				echo "<a href='master_minat.php?cmhs=$cmhs&cjur=$cjur&cang=$cang&page=".(($page+1)-1)."'> ".Back." </a>";
			}
			for($i=getPagingMhs($page);$i<=getPageSearchMhsMinat($cmhs,$cjur,$cang,$page,$jur)+1;$i++)
			{
				if($i==getPagingMhs($page)){
					if($page+1==$i) {
						echo "<b>".$i."</b>";
					}
					else {
						echo "<a href='master_minat.php?cmhs=$cmhs&cjur=$cjur&cang=$cang&page=$i'>".$i."</a>";
					}
				}
				else{
					if($page+1==$i) {
						echo " - <b>".$i."</b>";
					}
					else {
						echo " - <a href='master_minat.php?cmhs=$cmhs&cjur=$cjur&cang=$cang&page=$i'>".$i."</a>";
					}
				}
			}
			if($_GET['page']<=getPageSearchMhsMinat($cmhs,$cjur,$cang,$page,$jur) && (getPageSearchMhsMinat($cmhs,$cjur,$cang,$page,$jur)>1))	{
				echo "<a href='master_minat.php?cmhs=$cmhs&cjur=$cjur&cang=$cang&page=".(($page+1)+1)."'> ".Next." </a>";
			}
			?></td>
          </tr>
          <tr>
            <td colspan="5" align="center">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountMhsMinat($cmhs,$cjur,$cang,$jur);?> </td>
          </tr>
        </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr valign="middle">
    <td width="220" align="right">Jurusan yang dipilih :      </td>
    <td colspan="2" align="left"><select name="slcMinat" class="stext">
      <option  value="0">-Pilihan Jurusan-</option>
	  <?
	  		$minat = getMinat($jur);
			if($minat)	{
				foreach($minat as $display)	{
					?>
						<option value="<? echo $display['kode_jur']?>"><? echo $display['nama'];?></option>
					<?
				}
			}
	  ?>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="submit" name="cmdUbah" value=" Ubah " class="sbutton"></td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  </form>
</table>


