<?
  ini_set('max_execution_time',300);
  ini_set('memory_limit','512M');
  if ( file_exists('../inc/functions/f_member.php') )  include_once('../inc/functions/f_member.php');
  else if ( file_exists('./inc/functions/f_member.php') )  include_once('./inc/functions/f_member.php');
	if(isset($_SESSION['mhs_id']))
	{

?>

<table width="150" border="0" cellspacing="0" cellpadding="0" class="navWrapper">
 <tr>
		<td width="147" class="navHeader" >Welcome,<b><? echo $_SESSION['mhs_id']; ?></b></td>
  </tr>
  <tr>
    <td width="147">
	<ul class="nav">
		<li class="nav"><a href="mahasiswa.php">Profil Mahasiswa</a></li>
    <li class="nav"><a href="/perwalianft.php/minat_mk.html">Daftar Minat Matakuliah</a></li>
		<li class="nav"><a href="daftar_mk.php">Daftar Kelas Matakuliah</a></li>
		<li class="nav"><a href="information.php">Informasi Mata Kuliah</a></li>
		<li class="nav"><a href="jadwal.php">Jadwal Matakuliah</a></li>
		<li class="nav"><a href="transkrip.php">Transkrip</a></li>
		<li class="nav"><a href="hasil_perwalian.php">History Perwalian</a></li>
		<li class="nav"><a href="logout.php">Keluar</a></li>
	</ul>
	</td>
  </tr>
</table>
<?
	}
	else if(isset($_SESSION['admin_id']))
	{
?>
		<table width="150" border="0" cellspacing="0" cellpadding="0" class="NavWrapper">
		  <tr>
			<td width="241" class="navHeader">Welcome,<b><? echo $_SESSION['admin_id']; ?></b></td>
		  </tr>
		  <tr>
			<td>
				<ul class="nav">
					<!-- <li class="nav"><a href="upload.php">Upload Database</a></li>-->
					<li class="nav"><a href="/admin/master_mhs.php?lihat=1">Master Mahasiswa</a></li>
					<li class="nav"><a href="/admin/master_mk.php?lihat=1">Master Mata Kuliah</a></li>
					<li class="nav"><a href="/admin/master_dosen.php">Master Dosen</a></li>
					<li class="nav"><a href="/admin/master_ruang.php">Master Ruang</a></li>
					<li class="nav"><a href="/admin/master_jur.php">Master Jurusan</a></li>
<li class="nav"><a href="/perwalianft.php/minat_mk/list_per_jurusan.html">Rekapitulasi Minat MK</a></li>
					<li class="nav"><a href="/admin/kelas_mk.php?kelas=1">Manage Kelas MK</a></li>
					<li class="nav"><a href="/admin/jadwal_ujian.php?ujian=1">Manage Jadwal Ujian</a></li>
					<li class="nav"><a href="/admin/asisten.php">Manage Assisten</a></li>
					<li class="nav"><a href="/admin/manage_sks.php">Manage Tambah SKS</a></li>
					<li class="nav"><a href="/admin/perwalian.php">Manage Perwalian</a></li>
					<li class="nav"><a href="/admin/lap_perwalian.php">Laporan Perwalian</a></li>
					<li class="nav"><a href="/admin/setting_admin.php">Setting Admin</a></li>
					<li class="nav"><a href="../logout.php">Keluar</a></li>
				</ul></td>
		  </tr>
</table>
<?
	}
	else if(isset($_SESSION['paj_id']))
	{
		$checkLogin = getDetailLogin();
		$status = $checkLogin['jabatan'];
		if($status=='PAJ')	{
			$jur = $checkLogin['kode_jur'];
			$add = "&jur=".$jur;
		}
	?>
		<table width="150" border="0" cellspacing="0" cellpadding="0" class="NavWrapper">
		  <tr>
			<td width="241" class="navHeader">Welcome,<b><? echo $_SESSION['paj_id']; ?></b></td>
		  </tr>
		  <tr>
			<td>
				<ul class="nav">
					<? if(checkMinat($jur))	{
						?>
						<li class="nav"><a href="/admin/master_minat.php?lihat=1">Manage Penjurusan</a></li>
						<?
					}
					?>
					<li class="nav"><a href="/admin/master_mhs.php?lihat=1">Master Mahasiswa</a></li>
					<li class="nav"><a href="/admin/master_mk.php?lihat=1">Master Mata Kuliah</a></li>
<li class="nav"><a href="/perwalianft.php/minat_mk/list_per_jurusan.html">Rekapitulasi Minat MK</a></li>

					<li class="nav"><a href="/admin/kelas_mk.php?kelas=1<? echo $add;?>">Manage Kelas MK</a></li>
					<li class="nav"><a href="/admin/jadwal_ujian.php?ujian=1<? echo $add;?>">Manage Jadwal Ujian</a></li>
					<li class="nav"><a href="/admin/asisten.php">Manage Assisten</a></li>
          <li class="nav"><a href="/admin/lap_perwalian.php">Laporan Perwalian</a></li>
					<li class="nav"><a href="../logout.php">Keluar</a></li>
			</ul></td>
		  </tr>
		</table>
	<?
	}
	else
	{
?>


	<form method="post" name="frmLogin" action="/login.php">
		<table border="0" cellspacing="0" cellpadding="0" class="navWrapper" width="150" >
		  <tr>
			<td  colspan="2" class="navHeader">Login</td>
		  </tr>
		  <tr >
			<td width="74" height="23" align="right" class="navLogin">NRP/NIK : </td>
			<td width="76" ><input type="text" name="txtNrp" class="stext" size="8"></td>
		  </tr>
		  <tr>
			<td  align="right" height="23" class="navLogin">Password :</td>
			<td ><input type="password" name="txtPassword" class="stext" size="8"></td>
		  </tr>
		  <tr align="center">
		    <td colspan="2" height="23" class="navLogin"><input type="submit" name="cmdLogin" value="Login" class="sbutton"></td>
	      </tr>
	  </table>
	</form>
	<table border="0" cellspacing="0" cellpadding="0" class="navWrapper" width="150" >
		  <tr>
			<td class="navHeader">Link</td>
		  </tr>
		  <tr >
		    <td align="center">&nbsp;</td>
      </tr>
		  <tr >
			<td align="center" ><a href="http://ubaya.ac.id/info"><img src="images/linkInfo.gif" width="120" height="24" border="0"></a></td>
		  </tr>
		  <tr align="center">
		    <td height="25" class="navLogin">&nbsp;</td>
	      </tr>
	  </table>
<?
	}
?>

