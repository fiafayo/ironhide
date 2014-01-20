<?
if($_POST['cmdStatus'])	{
	$hasil = editStatusMhs($_GET['nrp'],strtoupper($_POST['txtStatus']));
	if($hasil)	{
		$inf = "Status mahasiswa ".$_GET['nrp']." telah diubah";
	}
	else	{
		$error = "Status mahasiswa ".$_GET['nrp']." gagal diubah";
	}
}
$result = getDetailMhs($_GET['nrp']);

?>
<table width="508" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td class="subHeaderMenu">
	<?
		if($_GET['minat'])	{
			echo "<a href='master_minat.php?lihat=1'>Daftar Mahasiswa Peminatan</a>";
		}
		else	{
			echo "<a href='master_mhs.php?lihat=1'>Daftar Mahasiswa Fakultas Teknik</a>";
		}?>
		 &gt; Detail Mahasiswa </td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="508" align="center"><?
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
    <td align="center"><table width="484" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td colspan="2" class="subHeaderMenu">Profile Mahasiswa </td>
        </tr>
        <tr>
          <td width="172">&nbsp;</td>
          <td width="312">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">NRP : </td>
          <td>&nbsp;<b><? echo $result['nrp']; ?></b></td>
        </tr>
        <tr>
          <td align="right">Nama : </td>
          <td>&nbsp;<strong><? echo $result['nama']; ?></strong></td>
        </tr>
        <tr>
          <td align="right">SKS Max : </td>
          <td>&nbsp;<strong><? echo $result['sksmax']; ?></strong></td>
        </tr>
        <tr>
          <td align="right">IPS :</td>
          <td>&nbsp;<strong><? echo $result['ips']; ?></strong></td>
        </tr>
        <tr>
          <td align="right">IPK : </td>
          <td>&nbsp;<strong><? echo $result['ipk']; ?></strong></td>
        </tr>
        <tr>
          <td align="right">SKS Kum : </td>
          <td>&nbsp;<strong><? echo $result['skskum']; ?></strong></td>
        </tr>
        <tr>
          <td align="right">Status :</td>
          <td>&nbsp;<strong><? echo $result['status']; ?></strong></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center" class="subHeaderMenu"><strong>Status Perkuliahan </strong></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">Jurusan : </td>
          <td>&nbsp;<strong><?
		  $jurusan = getDetailJurusan($result['jurusan']);
		  echo $jurusan['nama']; ?></strong></td>
        </tr>
        <tr>
          <td align="right">Angkatan : </td>
          <td>&nbsp;<strong><? echo getAngkatanMhs($_GET['nrp']); ?></strong></td>
        </tr>
        <tr>
          <td align="right">Total BSS : </td>
          <td>&nbsp;<strong><? echo $result['totbss']; ?></strong></td>
        </tr>
        <tr>
          <td align="right">Alamat : </td>
          <td>&nbsp;<strong><? echo $result['alamat']; ?></strong></td>
        </tr>
        <tr>
          <td align="right">Telepon : </td>
          <td>&nbsp;<strong><? echo $result['telepon']; ?></strong></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center" class="subHeaderMenu"><strong> Data Pribadi</strong></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">Jenis Kelamin :</td>
          <td>&nbsp;<strong><? echo $result['kelamin']; ?></strong></td>
        </tr>
        <tr>
          <td align="right">Nama SMA : </td>
          <td>&nbsp;<strong><? echo $result['namasma']; ?></strong></td>
        </tr>
        <tr>
          <td align="right">Nama orang tua : </td>
          <td>&nbsp;<strong><? echo $result['namaortu']; ?></strong></td>
        </tr>
        <tr>
          <td align="right">Tempat / Tanggal Lahir : </td>
          <td>&nbsp;<strong><? echo $result['tmplahir'].",".$result['tgllahir']; ?></strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
		<? if($_SESSION['admin_id'])	{?>
		<form name="frmUbahStatus" method="post">
        <tr>
          <td colspan="2"  class="subHeaderMenu">Ubah Status </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">Status baru : </td>
          <td><input name="txtStatus" type="text" class="stext" size="5" maxlength="2">
            <input type="submit" name="cmdStatus" value="Ubah" class="sbutton"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
		</form>
		<?
		}
		?>
    </table></td>
  </tr>
  <tr>
    <td>
	<?
		if($_GET['minat'])	{
			echo "<a href='master_minat.php?lihat=1'>[Kembali]</a>";
		}
		else	{
			echo "<a href='master_mhs.php?lihat=1'>[Kembali]</a>";
		}?>
	</td>
  </tr>
</table>

<?php
  $nrp=$result['nrp'];
  $kode=substr($nrp,3,1);
  if ($kode=='2') {
      //heloz
           print '<input type="button" name="gantiJurBtn" value="Ganti Jurusan" onclick="document.location=\'/index.php/depan/ganti_jurusan?nrp='.$_GET['nrp'].'\'">';
  }
?>
