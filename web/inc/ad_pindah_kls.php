<?
$kode_kls=$_REQUEST['kode_kls'];
	$detail = getDetailKlsMk($kode_kls);
	if(checkPindahKls($_GET['fpp'],$_GET['kode_kls'])==0)	{
		$error = "Tidak ada kelas pengganti";
	}
	else	{
		if($_POST['cmdProses'])	{
			if(($_POST['slcKpGanti']!='0') && ($_POST['txtJmlPindah']!=""))	{
				$kodeKlsBaru = $_POST['slcKpGanti'];
				$kodeKls = $_GET['kode_kls'];
				$jmlIsiKls = $detail['isi']+getPendaftarKls($_GET['fpp'], $kodeKls);
				$klsPengganti = getDetailKlsMk($kodeKlsBaru);
				$jmlPindah = $_POST['txtJmlPindah'];
				$isi =$_POST['txtJmlPindah'];
				if(($klsPengganti['isi']+$isi)<$klsPengganti['kapasitas'])		{
					if($isi <= $jmlIsiKls)	{
						$result = prosesPindahKls($_GET['fpp'],$kodeKls,$kodeKlsBaru,$jmlPindah);
						if($result)		{
							$inf = "Perpindahan kelas berhasil dilakukan";
						}
						else	{
							$error = "Perpindahan kelas gagal";
						}
					}
					else	{
						$error = "Jumlah melebihi kapasitas lama";
					}
				}
				else	{
					$error = "Jumlah melebihi kapasitas kelas baru";
				}
			}
			else	{
				$error = "Pengisian data kurang lengkap";
			}
		}
	}
?>
<table width="520" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="subHeaderMenu"><a href="perwalian.php">Daftar Perwalian </a>&gt;<a href="perwalian.php?preview=1&fpp=<? echo $_GET['fpp'];?>"> Daftar MK </a>&gt; <a href="perwalian.php?fpp=<? echo $_GET['fpp'];?>&kode_mk=<? echo $detail['kode_mk'];?>"> Daftar Kelas MK </a>&gt; Proses Pindah Kelas MK</td>
  </tr>
  <tr>
    <td align="center"><span class="labelContent">
      <?
			if($error)
			{
				echo "<div class='warning'>".$error."</div>";
			}
			elseif($inf)
			{
				echo "<div class='information'>".$inf."</div>";
			}
		?>
    </span></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">
	<form name="frmPindahKls" method="post">
	<table width="489" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="253" align="right">Kode Mata Kuliah : </td>
        <td width="247" class="labelContent"><? echo $detail['kode_mk']?></td>
      </tr>
      <tr>
        <td align="right">Nama Mata Kuliah : </td>
        <td class="labelContent"><? $nama= getDetailMK($detail['kode_mk']);
							 echo $nama['nama'];?></td>
      </tr>
      <tr>
        <td align="right">KP : </td>
        <td class="labelContent"><? echo $detail['kp']?></td>
      </tr>
      <tr>
        <td align="right">Kapasitas : </td>
        <td class="labelContent"><? echo $detail['kapasitas'];?></td>
      </tr>
      <tr>
        <td align="right">Jumlah Pendaftar : </td>
        <td class="labelContent"><? $jml_daftar = getPendaftarKls($_GET['fpp'], $detail['kode_kelas']);
									echo $jml_daftar;?></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td class="labelContent">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">KP Tujuan : </td>
        <td class="labelContent"><select name="slcKpGanti" class="stext" id="kodeKls" onChange="getKursiKosong()">
		<option value="0">-Pilih KP-</option>
		<?
			$pengganti = selectKpPengganti($detail['kode_mk'],$detail['kp']);
			foreach($pengganti as $kls)	{
				if(checkJadwalPengganti($detail['kode_kelas'],$kls['kode_kelas'])==true)	{
					echo "<option value='".$kls['kode_kelas']."'>".$kls['kp']."</option>";
				}
			}
		?>
		</select></td>
      </tr>
      <tr>
        <td align="right">Jumlah mahasiswa yang dipindah : </td>
        <td class="labelContent"><input type="text" name="txtJmlPindah" class="stext" size="3"></td>
      </tr>
      <tr>
        <td align="right">Kursi kosong : </td>
        <td class="labelContent">&nbsp;<span id="kursiKosong">None</span></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td class="labelContent">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td class="labelContent"><input type="submit" name="cmdProses" value="Proses" class="sbutton"></td>
      </tr>
    </table></form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="perwalian.php?fpp=<? echo $_GET['fpp'];?>&kode_mk=<? echo $detail['kode_mk'];?>">[Kembali]</a></td>
  </tr>
</table>
