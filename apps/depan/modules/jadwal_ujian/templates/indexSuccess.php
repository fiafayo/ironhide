<style >
.mk_ujian {
    margin: 0 0 8px 0;
}
</style>
<div id="sf_admin_container">
<?php
if (!$xls) {
  if ($jurusan) $jurusanId=$jurusan->getKodeJur(); else $jurusanId=$sf_request->getParameter('jurusan_id');
  if ($sf_user->isAuthenticated() && !$sf_user->isMahasiswa())
  {
    print '<div id="xls_form" style="margin:20px">';
    print '<a href="/admin/index.php">Home</a> - ';
    print '<a href="/admin/jadwal_ujian.php?jur='.$jurusanId.'&tambah=1">Input Jadwal Ujian</a> - <a href="/admin/jadwal_ujian.php?jur='.$jurusanId.'&list=1"> Daftar Jadwal Ujian </a> - <a href="/admin/jadwal_ujian.php?jur='.$jurusanId.'">Lihat Jadwal Ujian</a>';
    print '</div>';
  }
}
?>

<?php if (!$xls) include_partial('jadwal_ujian/filter',array('jurusan'=>$jurusan)); ?>

<h1>Jadwal Ujian <?php if ($jurusan) print $jurusan->getNama(); else print $jurusanId; ?> </h1>
<?php
if (!$xls) {
  print '<div id="xls_form" style="margin:20px">';
  print form_tag('http://'.$_SERVER['HTTP_HOST'].'/index.php/jadwal_ujian');
  print '<input type="hidden" name="jurusan_id" value="'.$jurusanId.'" />';
  print '<input type="hidden" name="xls" value="1" />';
  print '<input type="submit" name="Commmit" value="Klik disini untuk membuat file XLS" />';
  print '</form></div>';
}
$hariNames=array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
$jadwals=array();
for ($m=1;$m<=2;$m++) {
  $jadwals[$m]=array();
  for ($h=1;$h<=6;$h++) {
    $jadwals[$m][$h]=array();
    for ($j=1;$j<=4;$j++) {
      $jadwals[$m][$h][$j]=array();
    }
  }
}
foreach ($jadwalUjians as $jadwalUjian) {
  $m=$jadwalUjian->getMinggu();
  $h=$jadwalUjian->getHari();
  $j=$jadwalUjian->getJam();
  $mk=$jadwalUjian->getMataKuliah();
  if ($mk) {
    $jadwals[$m][$h][$j][$mk->getKodeMk()]=$mk->getKodeMk().'-'.$mk->getNama();
    if ( array_key_exists($mk->getKodeMk(),$kodeMks) ) $kapasitas=$kodeMks[$mk->getKodeMk()];
    else $kapasitas=0;
    $jadwals[$m][$h][$j][$mk->getKodeMk()] .= " ($kapasitas)";
  }
}
?>
<table  class="sf_admin_list" border="1">
<TR>
  <TH style="text-align:center" colspan="7">Minggu Ke-1</TH>
</TR>
<TR>
  <TH style="text-align:center">Hari/Jam</TH>
<?php
$i=0;
foreach ($hariNames as $hariName) {
  if ($i++) print  '<TH style="text-align:center">'.$hariName.'</TH>';
}
?>
</TR>
<?php
$genap=0;
for ($j=1;$j<=4;$j++) {
    if ($genap) $genap=0; else $genap=1;
  print '<TR class="sf_admin_row_'.$genap.'"><TD align="center">'.$j.'</TD>';
  for ($h=1;$h<=6;$h++) {
    print '<TD>';
    $mks=$jadwals[1][$h][$j];
    $mkText='';
    foreach ($mks as $mk) {
      //if ($mkText) $mkText.='<BR/>';
      $mkText.= '<div class="mk_ujian">'. $mk.'</div>';
    }
    print $mkText.'&nbsp;</TD>';
  }
  print '</TR>';
}
?>

<TR>
  <TH style="text-align:center" colspan="7">Minggu Ke-2</TH>
</TR>
<TR>
  <TH style="text-align:center">Hari/Jam</TH>
<?php
$i=0;
foreach ($hariNames as $hariName) {
  if ($i++) print  '<TH style="text-align:center">'.$hariName.'</TH>';
}
?>
</TR>

<?php
$genap=0;
for ($j=1;$j<=4;$j++) {
    if ($genap) $genap=0; else $genap=1;
  print '<TR class="sf_admin_row_'.$genap.'"><TD align="center">'.$j.'</TD>';

  for ($h=1;$h<=6;$h++) {
    print '<TD>';
    $mks=$jadwals[2][$h][$j];
    $mkText='';
    foreach ($mks as $mk) {
      //if ($mkText) $mkText.='<BR/>';
      $mkText.= '<div class="mk_ujian">'. $mk.'</div>';
    }
    print $mkText.'&nbsp;</TD>';
  }
  print '</TR>';
}
?>

</table>
</div>