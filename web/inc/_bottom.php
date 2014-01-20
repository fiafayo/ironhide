<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
</div>
    </div>
	<div id="rightcolumn">

<?php
if ( isset($_SESSION['mhs_id']) &&  $_SESSION['mhs_id'] )
{
?>
<div class="module_menu">
    <div>

        <div>
            <div>
                <h3>Data Perwalian</h3>

<ul class="menu">
    <li ><a href="/"><span>Home</span></a></li>
		<li class="nav2"><a href="/mahasiswa.php">Profil Mahasiswa Ini</a></li>

		<li class="nav2"><a href="/daftar_mk.php">Daftar Kelas Matakuliah</a></li>

		<li class="nav2"><a href="/information.php">Informasi Mata Kuliah</a></li>
		<li class="nav2"><a href="/jadwal.php">Jadwal Matakuliah</a></li>

		<li class="nav2"><a href="/transkrip.php">Transkrip</a></li>
		<li class="nav2"><a href="/hasil_perwalian.php">History Perwalian</a></li>
		<li class="nav2"><a href="/logout.php">Keluar</a></li>
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
                <div  style="text-align:center"><?php echo $_SESSION['nama']; ?></div>
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
if ( isset($_SESSION['admin_id']) &&  $_SESSION['admin_id'] )
{

?>

<div class="module_menu">
    <div>
        <div>
            <div>
                <h3>Setup Perwalian</h3>

<ul class="menu">
    <li ><a href="/"><span>Home</span></a></li>
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
					<li class="nav2"><a href="/berita">Berita</a></li>
					<li class="nav2"><a href="/toefl">Lulus TOEFL</a></li>
					<li class="nav2"><a href="/advisor">Konsultasi AA</a></li>

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
if ( isset($_SESSION['paj_id']) &&  $_SESSION['paj_id'] )
{

?>

<div class="module_menu">
    <div>
        <div>
            <div>
                <h3>Setup Perwalian</h3>

<ul class="menu">


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




    </div>

     <br clear="all" />
    <img id="main_bottom" src="/templates/colourful/images/blue/bottom.png" alt="bottom" align="bottom" /></div>
<!--
<script language="javascript" type="text/javascript">
cmDraw ('pillmenu', myMenu, 'hbr', cmThemeGray);


</script>
-->

</body>


</html>