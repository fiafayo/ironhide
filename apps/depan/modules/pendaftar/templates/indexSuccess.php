<?php
  //use_helper("Form",'Object','Javascript');
  $xls=$sf_request->getParameter('xls','0');
  $fpp=$sf_request->getParameter('fpp','ALL');
  $jurusans=JurusanPeer::doSelect(new Criteria());
  $jurusanOptions=array();
  foreach ($jurusans as $jurusan) {
    $jurusanOptions[$jurusan->getKodeJur()]=$jurusan->getNama();
  }
  $jurusanOptions['MIPA']='MIPA';
  $jurusanOptions['MKU']='MKU';
  $jurusanOptions['ALL']='SEMUA JURUSAN';
  $kode_jur=$sf_request->getParameter('kode_jur','ALL');
  $namaJurusan='';
  if (array_key_exists($kode_jur,$jurusanOptions)) $namaJurusan=$jurusanOptions[$kode_jur];
  $selectJurusanOptions='';
  $keys=array_keys($jurusanOptions);
  foreach ($keys as $key)
  {
      $value=$jurusanOptions[$key];
      if ($key==$kode_jur) $selected='selected="true"'; else $selected='';
      $selectJurusanOptions.='<OPTION value="'.$key.'" '.$selected.' >'.$value.'</OPTION>';
  }
  $selectStatusOptions='';
  $status=$sf_request->getParameter('status','1');
  $statusOptions=array('0'=>'Peminat','1'=>'Diterima','2'=>'Ditolak');
  $keys=array_keys($statusOptions);
  foreach ($keys as $key)
  {
      $value=$statusOptions[$key];
      if ($key==$status) $selected='selected="true"'; else $selected='';
      $selectStatusOptions.='<OPTION value="'.$key.'" '.$selected.' >'.$value.'</OPTION>';
  }

  
  
  $fppOptions=array('I11GA'=>'FPP I','II11GA'=>'FPP II','KK11GA'=>'Kasus Khusus','ALL'=>'Semua tahap');

  $fppSelectOptions='';

   
  $keys=array_keys($fppOptions);
  foreach ($keys as $key)
  {
      $value=$fppOptions[$key];
      if ($key==$fpp) $selected='selected="true"'; else $selected='';
      $fppSelectOptions.='<OPTION value="'.$key.'" '.$selected.' >'.$value.'</OPTION>';
  }
  
?>
<div id="sf_admin_container">
<?php
if (!$xls) {
?>
<div id="nonxls" style="margin:20px">
<?php
print form_tag('pendaftar/index',array('method'=>'get'));
?>

<table border="0" class="sf_admin_filters">
<TR>
  <TD>Jurusan:</TD>
  <TD>
<?php
  print '<SELECT name="kode_jur" id="kode_jur" onchange="this.form.submit()">'. $selectJurusanOptions.'</SELECT>';
?>  
  </TD>
</TR>
<TR>
  <TD>Status :</TD>
  <TD>
<?php
  print '<SELECT name="status" id="status" onchange="this.form.submit()">'. $selectStatusOptions.'</SELECT>';

?>  
  </TD>
</TR>

<TR>
  <TD>Fpp :</TD>
  <TD>
<?php
  print   '<SELECT name="fpp" id="fpp" onchange="this.form.submit()">'. $fppSelectOptions.'</SELECT>';

?>  
  </TD>
</TR>

</table>
<input type="submit" name="xls" value="Buat file XLS" />
</form>
<?php 
  //print  '<INPUT type="button" name="button1" value="Home"  onclick="document.location=/index.php" />&nbsp;';
  
  //print button_to_function('Klik di sini untuk membuat file XLS',"document.location='/perwalianft.php/pendaftar.html?kode_jur=$kode_jur&status=$status&xls=1'"); ?>
</div>
<?php
} ?>
<h1>Daftar <?php
$jenisMhs='Mahasiswa';
switch ($status) {
  case 0 :
    $jenisMhs='Peminat';
    break;
  case 1 :
    $jenisMhs='Peserta';
    break;
  case 2 :
    $jenisMhs='Peminat Ditolak';
    break;
}
print $jenisMhs;
?> Mata Kuliah <?php print $namaJurusan; ?></h1>
<table class="sf_admin_list" border="1">
<thead>
<tr><TH>Mata Kuliah</TH><TH><?php print $jenisMhs;?></TH></tr>
</thead>
<tbody>
<?php

foreach ($kodeMks as $kodeMk) {
  if ( !isset($daftars[$kodeMk]) ) continue;
  
?>
<TR  >
  <TH colspan="2"><?php print $kodeMk.'. '.$matkuls[$kodeMk]->getNama(); ?>&nbsp;</TH>
</TR>

<?php
if ( isset($daftars[$kodeMk]) && is_array($daftars[$kodeMk]) )
{

  $kodeKelass=array_keys($daftars[$kodeMk]);
  $genap=1;
  foreach ($kodeKelass as $kodeKelas) {
    if ($genap) $genap=0; else $genap=1;
    $kelasMk=$kelasMks[$kodeKelas];
    
?>
<TR class="sf_admin_row_<?php echo $genap;?>">
  <TD valign="top" nowrap="true"><?php
    print 'Kode:'.$kelasMk->getKodeMk()."<br/>\r\n";
    print 'KP:'.$kelasMk->getKp()."<br/>\r\n";
    print 'Kapasitas:'.$kelasMk->getKapasitas()."<br/>\r\n";
    $nrps=array_keys($daftars[$kodeMk][$kodeKelas]);
    print 'Jumlah:'. count($nrps)  ;
    if ( array_key_exists($kodeKelas,$settingNrps) ) {
      print "<br/>\r\nSetting NRP :";
      $sets=$settingNrps[$kodeKelas];
      foreach ($sets as $set) print "<br/>\r\n&nbsp;&nbsp;".$set;
    }
  ?>&nbsp;</TD>
  <TD valign="top"><?php
   $no=1; 
   foreach ($nrps as $nrp) {
     if ($no!=1) print '- '; 
     print $nrp;
     $no++;
   }  
  ?>&nbsp;</TD>
</TR>

<?php
  }
}
?>

<?php
}
?>
</tbody>
</table>

</div>