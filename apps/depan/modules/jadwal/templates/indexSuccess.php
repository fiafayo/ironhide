<div id="sf_admin_container">
<?php
if (!$xls) {
  if ($jurusan) $jurusanId=$jurusan->getKodeJur(); else $jurusanId=$sf_request->getParameter('jurusan_id');
  if ($sf_user->isAuthenticated() && !$sf_user->isMahasiswa())
  {
    print '<div id="xls_form" style="margin:20px">';
    print '<a href="/admin/index.php">Home</a> - ';
    print '<a href="/admin/kelas_mk.php?tambah=1&jur='.$jurusanId.'&new=1">Input Kelas Mata Kuliah</a> - <a href="/admin/kelas_mk.php?tambah=1&jur='.$jurusanId.'&page=1">Lihat Status Kelas Mata Kuliah</a> - <a href="/admin/kelas_mk.php?jur='.$jurusanId.'">Lihat Jadwal Mata Kuliah</a>';
    print '</div>';
  }
}
?>

<?php if (!$xls) include_partial('jadwal/filter',array('jurusan'=>$jurusan)); ?>

<h1>Jadwal Kuliah <?php if ($jurusan) print $jurusan->getNama(); else print $jurusanId; ?> </h1>
<?php
if (!$xls) {
  print '<div id="xls_form" style="margin:20px">';
  print form_tag('http://'.$_SERVER['HTTP_HOST'].'/index.php/jadwal');
  print '<input type="hidden" name="jurusan_id" value="'.$jurusanId.'" />';
  print '<input type="hidden" name="xls" value="1" />';
  print '<input type="submit" name="Commmit" value="Klik disini untuk membuat file XLS" />';
  print '</form></div>';
}
?>

<table  class="sf_admin_list" border="1" style="z-index: 200">
<TR>
  <TH style="text-align:center">Hari</TH>
  <TH style="text-align:center">Jam Masuk</TH>
  <TH style="text-align:center">Jam Keluar</TH>
  <TH style="text-align:center">Kode MK</TH>
  <TH style="text-align:center">Mata Kuliah</TH>
  <TH style="text-align:center">Dosen</TH>
  <TH style="text-align:center">NRP</TH>
  <TH style="text-align:center">Kap</TH>
  <TH style="text-align:center">Ruang</TH>

</TR>
<?php
$hariNames=array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
$lastHari=0;
$genap=0;
$currJam='';
$genap=0;
foreach ($jadwalKuliahs as $jadwalKuliah) {
  $jamMasuk=$jadwalKuliah->getJamMasuk();
  if ($jamMasuk=='00.00') continue;
  $hari=$jadwalKuliah->getHari();

  if ($jamMasuk!=$currJam) {
    if ($genap) $genap=0; else $genap=1;
    $currJam=$jamMasuk;
  }
?>
<TR class="sf_admin_row_<?php print $genap;?>">
  <TD align="center"><?php  if ( array_key_exists($hari,$hariNames) ) print $hariNames[$hari]; else print $hari; ?></TD>
  <TD align="center"><?php print $jadwalKuliah->getJamMasuk(); ?></TD>
  <TD align="center"><?php print $jadwalKuliah->getJamKeluar(); ?></TD>
  <TD align="center"><?php
  //
    $kodeKelas=$jadwalKuliah->getKodeKelas();
    $kelasMk=$kelasMks[$kodeKelas];  if ($kelasMk) print $kelasMk->getKodeMk();

  ?>&nbsp;
  </TD>
  <TD><?php
  //
  if ($kelasMk) print $kelasMk->getMataKuliah()->getNama().'('.$kelasMk->getKp().')';
  ?>&nbsp;
  </TD>
   <TD nowrap="true"><?php
  //
  $dosenText='';
  if ($kelasMk) {
    $dosenKelass=$kelasMk->getDosenKelass();
    foreach ($dosenKelass as $dosenKelas) {
      $dosen=$dosenKelas->getDosen();
      if ($dosen) {
        if ($dosenText) $dosenText.="<br/>\r\n";
        $dosenText.= $dosen->getKodeDosen().' - '.$dosen->getNama();
      }
    }
  }
  print $dosenText;
  ?>&nbsp;
  </TD>

   <TD align="center"><?php
  //
  $nrpText='';
  if ($kelasMk) {
    $settingNrps=$kelasMk->getSettingNrps();
    foreach ($settingNrps as $settingNrp) {
      $nrpAwal=$settingNrp->getNrpAwal();
      $nrpAkhir=$settingNrp->getNrpAkhir();
      if ($nrpAwal && $nrpAkhir) {
        if ($nrpText) $nrpText.="<br/>\r\n";
        $nrpText.= $nrpAwal.'-'.$nrpAkhir;
      }
    }
  }
  print $nrpText;
  ?>&nbsp;
  </TD>
  <TD align="center"><?php
  //
  if ($kelasMk) print $kelasMk->getKapasitas();
  ?>&nbsp;
  </TD>
  <TD><?php
    $ruang = trim( $jadwalKuliah->getKodeRuang());
    if ($ruang=='-') print '&nbsp;'; else print $ruang;
  ?></TD>

</TR>
<?php
}
?>
</table>

<?php //if (!$xls) include_partial('jadwal/filter',array('jurusan'=>$jurusan)); ?>
</div>
