<?
	if($_GET['cari'])	{
		$cmhs = $_GET['cmhs'];
		$cjur = $_GET['cjur'];
		$cang = $_GET['cang'];
	}
?>
<form name="frmMahasiswa" method="get">
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" class="subHeaderMenu">Daftar Mahasiswa Fakultas Teknik </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Cari berdasarkan Nama / Nrp : </td>
    <td><input type="text" name="cmhs" value="<? echo $cmhs; ?>" class="stext"></td>
  </tr>
  <tr>
    <td align="right">Jurusan : </td>
    <td><select name="cjur" class="stext">
      <option value="">- Pilih Jurusan -</option>
      <?
						$piljur = getJurusan();
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
    <td align="right">Angkatan : </td>
    <td><input name="cang" type="text" class="stext" value="<? echo $cang; ?>" size="4" maxlength="4"></td>
  </tr>
  <tr>
    <td width="213" align="right">&nbsp;</td>
    <td width="287"><input type="submit" name="cari" value=" Cari " class="sbutton"></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><div class="listTable">
        <table width="488" border="0" cellspacing="0" cellpadding="0">
          <tr class="headerTable">
            <td width="33">No</td>
            <td>Nrp</td>
            <td width="268">Nama</td>
            <td width="89">Password</td>
            <td width="65">Status</td>
          </tr>
          <?
		  	if($_GET['page']) {
				$page = $_GET['page']-1;
			}
			else {
				$page = 0;
			}
			
	  		$pages = ($page)*LM_DISPLAY;
	  		$mhs = searchMhs($cmhs,$cjur,$cang,$pages);
			if($mhs)	{
				$i=$pages;
				foreach($mhs as $display)	{
				$i++;
	  ?>		
          <tr>
            <td align="center"><? echo $i;?></td>
            <td align="center"><? echo $display['nrp'];?></td>
            <td><a href="master_mhs.php?nrp=<? echo $display['nrp']; ?>"><? echo $display['nama'];?></a>&nbsp;</td>
            <td align="center"><? echo $display['password'];?></td>
            <td align="center"><? 
				if($display['status']!='')	{
					echo $display['status'];
				}
				else	{
					echo "-";
				}
				?></td>
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
			if(getPageCountMhs($cmhs,$cjur,$cang)>1)	{
				if(($_GET['page']!=1)&&(($_GET['page'])))	{
					echo "<a href='master_mhs.php?cmhs=$cmhs&cjur=$cjur&cang=$cang&page=".(($page+1)-1)."'> ".Back." </a>";
				}
				for($i=getPagingMhs($page);$i<=getPageSearchMhs($cmhs,$cjur,$cang,$page)+1;$i++)
				{
					if($i==getPagingMhs($page)){
						if($page+1==$i) {
							echo "<b>".$i."</b>";
						}
						else {
							echo "<a href='master_mhs.php?cmhs=$cmhs&cjur=$cjur&cang=$cang&page=$i'>".$i."</a>";
						}
					}
					else{
						if($page+1==$i) {
							echo " - <b>".$i."</b>";
						}
						else {
							echo " - <a href='master_mhs.php?cmhs=$cmhs&cjur=$cjur&cang=$cang&page=$i'>".$i."</a>";
						}
					}
				}
				if($_GET['page']<=getPageSearchMhs($cmhs,$cjur,$cang,$page) && (getPageSearchMhs($cmhs,$cjur,$cang,$page)>1))	{
					echo "<a href='master_mhs.php?cmhs=$cmhs&cjur=$cjur&cang=$cang&page=".(($page+1)+1)."'> ".Next." </a>";
				}
			}
			?></td>
          </tr>
          <tr>
            <td colspan="5" align="center">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountMhs($cmhs,$cjur,$cang);?></td>
          </tr>
        </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</form>

