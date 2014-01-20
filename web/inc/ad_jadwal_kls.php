<?
	if($_GET['delJwl'])	{
		$result = deleteJadwalKls($_GET['delJwl']);
	}
	
	if($_POST['cmdSaveJadwal'])	{
		if(($_POST['txtMasuk']!="") && ($_POST['txtKeluar']!=""))	{
			$kode_kelas = $_GET['kode'];
			$kode_ruang = $_POST['slcRuang'];
			$masuk = $_POST['txtMasuk'];
			$keluar = $_POST['txtKeluar'];
			$hari  = $_POST['slcHari'];
			if(checkDuplicateJadwalKls($kode_kelas,$masuk,$keluar,$hari)==0)	{
				$result = insertJadwalKls($kode_kelas,$kode_ruang,$masuk,$keluar,$hari);
				if($result)	{
					$inf = "Jadwal Kelas Mata kuliah telah berhasil disimpan";
				}
				else	{
					$error = "Jadwal Kelas Mata kuliah gagal disimpan";
				}
			}
			else	{
				$error = "Jadwal Kelas Mata kuliah bertumbukan";
			}
		}
		else	{
			$error = "Pengisian data kurang lengkap";
		}
	}
	
	if($_GET['jadwal'])	{
		$kls = getDetailKlsMk($_GET['kode']);
	}
?>

<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="632" align="center" class="subHeaderMenu"><a href="kelas_mk.php?kelas=1">Manage Jadwal Kelas MK<? $nama = getDetailJurusan($_GET['jur']);
	if($nama)	{
		echo " ".$nama['nama'];
	}?>
    </a> &gt; <a href="kelas_mk.php?tambah=1&jur=<? echo $_GET['jur'];?>&page=1">Status Kelas Mata Kuliah</a> &gt; Input Jadwal Kelas MK</td>
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
    <td align="center"><form name="frmJadwal" method="post" action="kelas_mk.php?tambah=1&jadwal=1&jur=<? echo $_GET['jur'];?>&kode=<? echo $_GET['kode'];?>">
	<table width="480" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="250" align="right">&nbsp;</td>
        <td width="230" class="labelContent">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">Kode Mata Kuliah :</td>
        <td class="labelContent">&nbsp;<? echo $kls['kode_mk'];?></td>
      </tr>
      <tr>
        <td align="right">Nama Mata Kuliah : </td>
        <td class="labelContent">&nbsp;<? $nama=getDetailMk($kls['kode_mk']);
					echo $nama['nama'];?></td>
      </tr>
      <tr>
        <td align="right">KP : </td>
        <td class="labelContent">&nbsp;<? echo $kls['kp'];?></td>
      </tr>
      <tr>
        <td align="right">Hari : </td>
        <td><select name="slcHari" class="stext">
            <option value="1">Senin</option>
            <option value="2">Selasa</option>
            <option value="3">Rabu</option>
            <option value="4">Kamis</option>
            <option value="5">Jumat</option>
            <option value="6">Sabtu</option>
        </select></td>
      </tr>
      <tr>
        <td align="right">Jam Mulai : </td>
        <td><input name="txtMasuk" type="text" class="stext" size="5" maxlength="5">
        (format : hh.mm)</td>
      </tr>
      <tr>
        <td align="right">Jam Selesai : </td>
        <td><input name="txtKeluar" type="text" class="stext" size="5" maxlength="5">
(format : hh.mm)</td>
      </tr>
      <tr>
        <td align="right">Kode Ruang : </td>
        <td><select name="slcRuang" class="stext">
            <option value="-">- Pilih Ruang Kuliah -</option>
            <?
			$ruang = selectDropRuang();
			foreach($ruang as $display)	{
				echo "<option value='".$display['kode_ruang']."'>".$display['kode_ruang']."</option>";
			}
		?>
        </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="cmdSaveJadwal" value="Simpan" class="sbutton">
			<input type="reset" name="cmdReset" value="Reset" class="sbutton"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    </form>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">
	<div class="listTable">
	<table width="345" cellspacing="0" cellpadding="0">
      <tr class="headerTable">
        <td width="37">Hari</td>
        <td width="76">Jam Masuk </td>
        <td width="75">Jam Keluar </td>
        <td width="96">Kode Ruang </td>
        <td width="33">Hapus</td>
      </tr>
	  <?
	  	$result = selectJadwalKls($_GET['kode']);
		if($result)	{
			foreach($result as $display)	{
	  ?>
      <tr>
        <td align="center"><? echo $display['hari'];?></td>
        <td align="center"><? echo $display['jam_masuk'];?></td>
        <td align="center"><? echo $display['jam_keluar'];?></td>
        <td align="center"><? echo $display['kode_ruang'];?></td>
        <td align="center">	
		<a href="kelas_mk.php?tambah=1&jadwal=1&jur=<? echo $_GET['jur'];?>&kode=<? echo $_GET['kode'];?>&delJwl=<? echo $display['kode_jadwal'];?>"><img src="../images/ico/delete.png"></a></td>
      </tr>
	  <?
	  		}
	  	}
		else	{
	  ?>
	  <tr align="center">
        <td colspan="5">Tidak ada Jadwal Kuliah</td>
      </tr>
	  <?
	  }
	  ?>
    </table></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="kelas_mk.php?tambah=1&jur=<? echo $_GET['jur'];?>">[Kembali]</a></td>
  </tr>
</table>
