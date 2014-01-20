<?php
if (  $sf_user->isAdministrator())
{

?>

<div class="module_menu">
    <div>
        <div>
            <div>
                <h3>Setup Perwalian</h3>

<ul class="menu">
    <li ><a href="<?php echo url_for('@homepage');?>"><span>Home</span></a></li>
					<li class="nav2"><a href="/admin/master_mhs.php?lihat=1">Master Mahasiswa</a></li>

					<li class="nav2"><a href="/admin/master_mk.php?lihat=1">Master Mata Kuliah</a></li>
					<li class="nav2"><a href="/admin/master_dosen.php">Master Dosen</a></li>
					<li class="nav2"><a href="/admin/master_ruang.php">Master Ruang</a></li>
					<li class="nav2"><a href="/admin/master_jur.php">Master Jurusan</a></li>
                                       <!-- <li class="nav2"><a href="/perwalianft.php/minat_mk/list_per_jurusan.html">Rekapitulasi Minat MK</a></li> -->
					<li class="nav2"><a href="/admin/kelas_mk.php?kelas=1">Manage Kelas MK</a></li>

					<li class="nav2"><a href="/admin/jadwal_ujian.php?ujian=1">Manage Jadwal Ujian</a></li>
					<li class="nav2"><a href="/admin/asisten.php">Manage Assisten</a></li>
					<li class="nav2"><a href="/admin/manage_sks.php">Manage Tambah SKS</a></li>
					<li class="nav2"><a href="/admin/perwalian.php">Manage Perwalian</a></li>
					<li class="nav2"><a href="/admin/lap_perwalian.php">Laporan Perwalian</a></li>
					<li class="nav2"><a href="/admin/setting_admin.php">Setting Admin</a></li>
					<li class="nav2"><a href="<?php echo url_for('@berita');?>">Berita</a></li>
                                        <li class="nav2"><a href="<?php echo url_for('@toefl');?>">Lulus TOEFL</a></li>
                                        <li class="nav2"><a href="<?php echo url_for('@advisor');?>">Konsultasi AA</a></li>
<li class="nav2"><a href="<?php echo url_for('@user_log');?>">User Log</a></li>
<li class="nav2"><a href="/semester/prosesBio">Sinkronisasi Biodata</a></li>
<li class="nav2"><a href="/index.php/konversi">Konversi Transkrip</a></li>
					<li class="nav2"><a href="/depan/logout">Keluar</a></li>
</ul>
            </div>
        </div>
    </div>
</div>
<!--
<div class="module_menu">
    <div>
        <div>
            <div>
                <h3>Penjadwalan Ujian</h3>

<ul class="menu">
    
                                        <li class="nav2"><a href="<?php echo url_for('@schedule_ruang');?>">Ruang</a></li>
                                        <li class="nav2"><a href="<?php echo url_for('@schedule_dosen');?>">Dosen</a></li>
                                        <li class="nav2"><a href="<?php echo url_for('@kelas_mk');?>">Kapasitas Kelas</a></li>
                                        <li class="nav2"><a href="<?php echo url_for('@schedule_karyawan');?>">Karyawan</a></li>
                                        <li class="nav2"><a href="<?php echo url_for('jadwal_ruang/generateRuang');?>">Buat Jadwal Ruang</a></li>
                                        <li class="nav2"><a href="<?php echo url_for('jadwal_ruang/generatePetugas');?>">Buat Jadwal Petugas</a></li>
                                        <li class="nav2"><a href="<?php echo url_for('jadwal_ujian/jadwalRinciDosen');?>">Jadwal Dosen</a></li>
                                        <li class="nav2"><a href="<?php echo url_for('jadwal_ujian/jadwalRinciKaryawan');?>">Jadwal Karyawan</a></li>
                                        
 <li class="nav2"><a href="<?php echo url_for('jadwal_ujian/jadwalRinci');?>">Jadwal Ujian dan Ruang</a></li>
					 
</ul>
            </div>
        </div>
    </div>
</div>
-->
<?php
}
?>

<?php
if (  $sf_user->isPaj())
{

?>

<div class="module_menu">
    <div>
        <div>
            <div>
                <h3>Setup Perwalian</h3>

<ul class="menu">
    <li ><a href="<?php echo url_for('@homepage');?>"><span>Home</span></a></li>
					<li class="nav2"><a href="/admin/master_mhs.php?lihat=1">Master Mahasiswa</a></li>
					<li class="nav2"><a href="/admin/master_mk.php?lihat=1">Master Mata Kuliah</a></li>


					<li class="nav2"><a href="/admin/kelas_mk.php?kelas=1<? echo $add;?>">Manage Kelas MK</a></li>
					<li class="nav2"><a href="/admin/jadwal_ujian.php?ujian=1<? echo $add;?>">Manage Jadwal Ujian</a></li>
					<li class="nav2"><a href="/admin/asisten.php">Manage Assisten</a></li>
          <li class="nav2"><a href="/admin/lap_perwalian.php">Laporan Perwalian</a></li>

					<li class="nav2"><a href="/depan/logout">Keluar</a></li>
</ul>
            </div>
        </div>
    </div>
</div>



<?php
}
?>

<?php
if (  $sf_user->isKasusKhusus())
{

?>

<div class="module_menu">
    <div>
        <div>
            <div>
                <h3>Kasus Khusus</h3>

<ul class="menu">
    <li ><a href="<?php echo url_for('@homepage');?>"><span>Home</span></a></li>
 <li class="nav2"><a href="/admin/lap_perwalian.php">Laporan Perwalian</a></li>
    <li ><a href="<?php echo url_for('kaskus');?>"><span>Kasus Khusus</span></a></li>
    <li class="nav2"><a href="/depan/logout">Keluar</a></li>
</ul>
            </div>
        </div>
    </div>
</div>



<?php
}
?>


<?php
if (  $sf_user->isMahasiswa())
{

?>

<div class="module_menu">
    <div>
        <div>
            <div>
                <h3>Data Perwalian</h3>

<ul class="menu">
    <li ><a href="<?php echo url_for('@homepage');?>"><span>Home</span></a></li>
		<li class="nav2"><a href="/mahasiswa.php">Profil Mahasiswa</a></li>
     
		<li class="nav2"><a href="/daftar_mk.php">Daftar Kelas Matakuliah</a></li>
		<li class="nav2"><a href="/information.php">Informasi Mata Kuliah</a></li>
		<li class="nav2"><a href="/jadwal.php">Jadwal Matakuliah</a></li>

		<li class="nav2"><a href="/transkrip.php">Transkrip</a></li>
		<li class="nav2"><a href="/hasil_perwalian.php">History Perwalian</a></li>
		<li class="nav2"><a href="/depan/logout">Keluar</a></li>
</ul>
            </div>
        </div>
    </div>
</div>
<div class="module_menu">
    <div>

        <div>
            <div>
                <h3>Data Mahasiswa</h3>
                <div style="text-align:center"><?php echo $_SESSION['nama']; ?></div>
                <ul class="menu">
                     
                <li >Nrp: <?php echo $_SESSION['mhs_id']; ?></li>
                 
                <li >SKS max: <?php echo $_SESSION['sksmax']; ?></li>
                 
                </ul>
            </div>
        </div>
    </div>
</div>


<?php
}
?>




<?php
if ( !$sf_user->isAuthenticated()   )
{
    if ( !((sfContext::getInstance()->getModuleName()=='depan') && (sfContext::getInstance()->getActionName()=='login')) )
    {

?>

<div class="module">
    <div>
        <div>
            <div>
                <h3>Pengguna</h3>
                <?php echo form_tag('depan/login'); ?>
                <fieldset class="input">
	<p id="form-login-username">
		<label for="modlgn_username">Username</label><br>
		<input id="modlgn_username" name="login[username]" class="inputbox" alt="username" size="18" type="text">
	</p>
	<p id="form-login-password">
		<label for="modlgn_password">Password</label><br>
		<input id="modlgn_password" name="login[password]" class="inputbox" alt="password" size="18" type="password">
	</p>
<input name="Submit" class="button" value="Login" type="submit">

                </fieldset>
                <?php echo '</form>'; ?>

            </div>
        </div>
    </div>
</div>
<?php
    }
} else if (!$sf_user->isMahasiswa())  {
?>

<div class="module">
    <div>
        <div>
            <div><h3>Pengguna</h3>
Selamat Datang, <br/>
<div style="color:blue"><?php echo $sf_user->getNama();?> <br/></div>

<?php
echo button_to('Logout', '@logout', array('class'=>'sbutton') ).'&nbsp;';
echo button_to('Ubah password', '@change_password', array('class'=>'sbutton'));
?>

            </div>
        </div>
    </div>
</div>
<?php
//$filterku=$sf_user->getAttribute('proposal.filters',array(),'admin_module');
//echo $filterku['laboratorium_id'];
}
?>


<div class="module_menu">
    <div>

        <div>
            <div>
                <h3>Jadwal</h3>

                <ul class="menu">

                <li ><?php echo link_to('Jadwal Kuliah','/index.php/jadwal')?> </li>
                <li ><?php echo link_to('Jadwal Ujian','/index.php/jadwal_ujian')?> </li>
                <!--
                <li class="nav2"><a href="<?php echo url_for('jadwal_ujian/jadwalRinci');?>">Jadwal Ujian dan Ruang</a></li>

                                        <li class="nav2"><a href="<?php echo url_for('jadwal_ujian/jadwalRinciDosen');?>">Jadwal Dosen</a></li>
                                        <li class="nav2"><a href="<?php echo url_for('jadwal_ujian/jadwalRinciKaryawan');?>">Jadwal Karyawan</a></li>
-->
                </ul>
            </div>
        </div>
    </div>
</div>



