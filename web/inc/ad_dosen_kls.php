<?
	if(($_GET['del']) && ($_GET['kode']))	{
		$result = deleteDosenKls($_GET['kode'],$_GET['del']);
	}
	
	if($_POST['cmdSaveDosen'])	{
		if($_POST['slcDosen']!="0")	{
			$kode_kelas = $_GET['kode'];
			$kode_dosen = $_POST['slcDosen'];
			if(checkDuplicateDosenKls($kode_kelas,$kode_dosen)==0)	{
				$result = insertDosenKls($kode_kelas,$kode_dosen);
				if($result)	{
					$inf = "Dosen Kelas Mata kuliah telah berhasil disimpan";
				}
				else	{
					$error = "Dosen Nrp Kelas Mata kuliah gagal disimpan";
				}
			}
			else	{
				$error = "Dosen Nrp Kelas Mata kuliah sudah ada";
			}
		}
		else	{
			$error = "Pengisian data kurang lengkap";
		}
	}
	
	if($_GET['dosen'])	{
		$kls = getDetailKlsMk($_GET['kode']);
	}?>
<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="subHeaderMenu"><a href="kelas_mk.php?kelas=1">Manage Jadwal Kelas MK
        <? $nama = getDetailJurusan($_GET['jur']);
	if($nama)	{
		echo " ".$nama['nama'];
	}?>
    </a> &gt; <a href="kelas_mk.php?tambah=1&jur=<? echo $_GET['jur'];?>&page=1">Status Kelas Mata Kuliah</a> &gt; Dosen Pengajar MK </td>
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
	<form name="frmDosen" method="post" action="kelas_mk.php?tambah=1&dosen=1&jur=<? echo $_GET['jur'];?>&kode=<? echo $_GET['kode'];?>">
	<table width="485" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="254" align="right">Kode  Mata Kuliah :</td>
        <td width="231" class="labelContent">&nbsp;<? echo $kls['kode_mk'];?></td>
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
        <td align="right">Kode Dosen : </td>
        <td><select name="slcDosen" class="stext" id="kodeDosen" onChange="getNamaDosen()">
		<option value="0">- Pilih Kode Dosen -</option>
		<?
			$result = selectAllDosen();
			if($result)	{
				foreach($result as $display)	{
					echo "<option value='".$display['kode_dosen']."'>".$display['kode_dosen']."</option>";
				}
			}
		?>
		</select>
		</td>
      </tr>
      <tr>
        <td align="right">Nama Dosen : </td>
        <td class="labelContent">&nbsp;<span id="namaDosen">None</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="cmdSaveDosen" class="sbutton" value="Simpan">
			<input type="reset" name="cmdReset" class="sbutton" value="Reset"></td>
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
	<table width="488" cellspacing="0" cellpadding="0">
      <tr class="headerTable">
        <td width="96">Kode Dosen </td>
        <td width="349">Nama Dosen </td>
        <td width="41">Hapus</td>
        </tr>
	<?
		$result = selectDosenKls($_GET['kode']);
		if($result)	{
			foreach($result as $display)	{
	?>
     	<tr>
        <td align="center"><? echo $display['kode_dosen'];?></td>
        <td><?
			$dosen = getDetailDosen($display['kode_dosen']);
			echo $dosen['nama'];
		?></td>
        <td align="center"><a href="kelas_mk.php?tambah=1&dosen=1&jur=<? echo $_GET['jur'];?>&kode=<? echo $_GET['kode'];?>&del=<? echo $display['kode_dosen'];?>"><img src="../images/ico/delete.png"></a></td>
        </tr>
	<?
			}
		}
		else	{ ?>
			<tr align="center">
			<td colspan="3">Dosen pengajar tidak ada</td>
		</tr> <?
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
