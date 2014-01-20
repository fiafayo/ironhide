<?
	if(($_GET['del']) && ($_GET['jur']))	{
		if(checkUsedJur($_GET['jur'])==true)	{
			$result = deleteJurusan($_GET['jur']);
			if($result)	{
				$inf = "Data Jurusan telah berhasil dihapus";
			}
		}
		else	{
			$error = "Data Jurusan telah terpakai";
		}
	}
	
	if($_POST['cmdSaveJur'])	{
		if(($_POST['txtKodeJur']!="") && ($_POST['txtNamaJur']!="") && ($_POST['txtKodeMinat']!=""))	{
			$kode_jur = strtoupper($_POST['txtKodeJur'])."-".strtoupper($_POST['txtKodeMinat']);
			if(checkDuplicateJur($kode_jur)==0)	{
				$nama = strtoupper($_POST['txtNamaJur']);
				$result = insertJurusan($kode_jur,$nama);
				if($result)	{
					$inf = "Data Jurusan telah berhasil disimpan";
				}
				else	{
					$error = "Data Jurusan gagal disimpan";
				}
			}
			else	{
				$error = "Data Jurusan telah ada";
			}
		}
		else {
			$error = "Pengisian data kurang lengkap";
		}
	}
?>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="subHeaderMenu">Input Jurusan Baru</td>
  </tr>
  <tr>
    <td align="center"><?
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
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><form name="frmJurusan" method="post" action="master_jur.php">
                        <table width="489" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="227" align="right">Kode Jurusan : </td>
                            <td width="262" ><input type="text" name="txtKodeJur" class="stext" size="6"> 
                            (sesuaikan dengan nrp) </td>
                          </tr>
                          <tr>
                            <td align="right">Kode Peminatan : </td>
                            <td><input name="txtKodeMinat" type="text" class="stext"  size="6">
(sesuaikan dengan nrp apabila ada) </td>
                          </tr>
                          <tr>
                            <td align="right">Nama Jurusan : </td>
                            <td><input type="text" name="txtNamaJur" class="stext"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" name="cmdSaveJur" class="sbutton" value="Simpan">
                                <input type="reset" name="cmdReset" class="sbutton" value="Reset"></td>
                          </tr>
                        </table>
                    </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><div class="listTable"><table width="452" cellspacing="0" cellpadding="0">
      <tr class="headerTable">
        <td width="84">Kode Jurusan </td>
        <td width="320">Nama Jurusan </td>
        <td width="46">Hapus</td>
      </tr>
      <?
	  	$result = getJurusan();
		if($result)	{
			foreach($result as $display)	{
	  ?>
      <tr>
        <td align="center"><? echo $display['kode_jur'];?></td>
        <td><? echo $display['nama'];?></td>
        <td align="center"><a href="master_jur.php?del=1&jur=<? echo $display['kode_jur'];?>"><img src="../images/ico/delete.png"></a></td>
      </tr>
      <?
	  		}
		}
		else	{
	  ?>
      <tr align="center">
        <td colspan="3">Tidak ada jurusan</td>
      </tr>
      <?
	  }
	  ?>
    </table></div></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><div align="justify"><b>* Keterangan:</b>
	      <ul>
		    <li>
		       Kode jurusan akan dibuat dari pengabungan kode jurusan dan kode peminatan </li>
		    <li> Pengisian kode peminatan yang tidak sesuai dengan nrp dapat menggunakan 2 digit angka random.<i>Contoh Teknologi Proses Pangan :62-01</i> </li>
		    <li> Pengisian jurusan yang tidak memiliki peminatan adalah dengan mengisi kode peminatan sama dengan kode jurusan.<i> Contoh Teknik Informatika : 64-64 </i></li>
        </ul>
    </div></td>
  </tr>
</table>
