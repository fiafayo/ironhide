<?
	if($_GET['del'])	{
		$result = deleteSettingKls($_GET['del']);
	}
	
	if($_POST['cmdSaveSetting'])	{
		if(($_POST['txtAwal']!="") && ($_POST['txtAkhir']!=""))	{
			$kode_kelas = $_GET['kode'];
			$nrp_awal = $_POST['txtAwal'];
			$nrp_akhir = $_POST['txtAkhir'];
			if($nrp_akhir >= $nrp_awal)	{
				if(checkDuplicateSettingKls($kode_kelas,$nrp_awal,$nrp_akhir)==0)	{
					$result = insertSettingKls($kode_kelas,$nrp_awal,$nrp_akhir);
					if($result)	{
						$inf = "Setting Nrp Kelas Mata kuliah telah berhasil disimpan";
					}
					else	{
						$error = "Setting Nrp Kelas Mata kuliah gagal disimpan";
					}
				}
				else	{
					$error = "Setting Nrp Kelas Mata kuliah sudah ada";
				}
			}
			else	{
				$error = "Nrp akhir harus lebih besar dari nrp awal";
			}
		}
		else	{
			$error = "Pengisian data kurang lengkap";
		}
	}
	
	if($_GET['setting'])	{
		$kls = getDetailKlsMk($_GET['kode']);
	}
?>
<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="subHeaderMenu"><a href="kelas_mk.php?kelas=1">Manage Jadwal Kelas MK
        <? $nama = getDetailJurusan($_GET['jur']);
	if($nama)	{
		echo " ".$nama['nama'];
	}?>
    </a> &gt; <a href="kelas_mk.php?tambah=1&jur=<? echo $_GET['jur'];?>&page=1">Status Kelas Mata Kuliah</a> &gt; Setting Nrp Kelas MK</td>
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
    <td align="center">
	<form name="frmJadwal" method="post" action="kelas_mk.php?tambah=1&setting=1&jur=<? echo $_GET['jur'];?>&kode=<? echo $_GET['kode'];?>">
	<table width="485" border="0" cellspacing="0" cellpadding="0">
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
        <td width="271" align="right">Nrp Awal : </td>
        <td width="214"><input name="txtAwal" type="text" class="stext" size="6" maxlength="7"></td>
      </tr>
      <tr>
        <td align="right">Nrp Akhir : </td>
        <td><input name="txtAkhir" type="text" class="stext" size="6" maxlength="7"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="cmdSaveSetting" value="Simpan" class="sbutton">
          <input type="reset" name="cmdReset" value="Reset" class="sbutton"></td>
      </tr>
    </table>
	</form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">
	<div class="listTable">
	<table width="285" cellspacing="0" cellpadding="0">
      <tr class="headerTable">
        <td width="131">Nrp Awal </td>
        <td width="114">Nrp Akhir </td>
        <td width="38">Hapus</td>
      </tr>
      <?
	  	$result = selectSettingKls($_GET['kode']);
		if($result)	{
			foreach($result as $display)	{
	  ?>
      <tr>
        <td align="center"><? echo $display['nrp_awal'];?></td>
        <td align="center"><? echo $display['nrp_akhir'];?></td>
        <td align="center"><a href="kelas_mk.php?tambah=1&setting=1&jur=<? echo $_GET['jur'];?>&kode=<? echo $_GET['kode'];?>&del=<? echo $display['id'];?>"><img src="../images/ico/delete.png"></a></td>
      </tr>
      <?
	  		}
	  	}
		else	{
	  ?>
      <tr align="center">
        <td colspan="3">Tidak ada setting nrp </td>
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
