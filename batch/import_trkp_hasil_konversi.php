<?php


require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('depan', 'dev', true);

echo "initialize database manager...\n";
$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->initialize($configuration);

/*
 * Isi file :
 NRP     NOMK   NILAI SEMESTER TAHUN
 6023112 600001 C
 6023112 602001 BC
 6023112 640322 D     Gasal    2002-2003
 6023112 604002 C     Gasal    2002-2003

 NRP     NOMK   NILAI SEMESTER TAHUN
6013146 000114 B     Gasal    2002-2003
6013146 00114A B     Gasal    2002-2003


 * 
 *  */



print "buka file CSV ... \n";
$bioFile="HASIL.TXT";
$csvIn=fopen($bioFile,"r");
if (!$csvIn) die ("gagal membaca $bioFile \n");
//$fieldNames=fgetcsv($csvIn,2048,';');
$no=1;
$format=" %7s %6s %5s %8s %9s";
//$input= fscanf($csvIn, $format, $nrp, $mk, $nilai, $semester, $tahun); //baca header
$input=fgets($csvIn, 1024);
$con=Propel::getConnection(TranskripPeer::DATABASE_NAME);
$con->beginTransaction();
//$input= fscanf($csvIn, $format, $nrp, $mk, $nilai, $semester, $tahun); //baca  baris pertama
$input=fgets($csvIn, 1024);
$nrp='';
$mk='';
$nilai='';
$semester='';
$tahun='';

while ($input) {
  ambildata($input, $nrp, $mk, $nilai, $semester, $tahun);  
  if ($nrp && $mk && $nilai) {
    $semester=trim($semester);
    $nilai=trim($nilai);
    $tahun=trim($tahun);
    $isValid=false;

    try {
      echo "NEW $nrp $mk ... ";
      $sql="INSERT INTO tk_transkrip (nrp,kode_mk,semester,tahun,nilai) VALUES ('$nrp','$mk','$semester','$tahun','$nilai')";
      $stmt=$con->prepare($sql);
      $stmt->execute();
      echo "$no \n";
      $isValid=true;
    } catch (Exception $e) {
      //echo "\nERR: executing $sql\nMSG: ".$e->getMessage()."\n";
    }
    if (!$isValid) {

    try {
      echo "EDIT $nrp $mk ... ";
      $sql="UPDATE tk_transkrip SET nilai='$nilai' WHERE nrp='$nrp' and  kode_mk='$mk' and semester='$semester' and tahun='$tahun'";
      $stmt=$con->prepare($sql);
      $stmt->execute();
      echo "$no \n";
    } catch (Exception $e) {
      echo "\nERR: executing $sql\nMSG: ".$e->getMessage()."\n";
    }        
    }
$no++;
  } else {
    echo "ERR: baris invalid nrp=$nrp mk=$mk nilai=$nilai semester=$semester tahun=$tahun \n";

  }
  $nrp='';
$mk='';
$nilai='';
$semester='';
$tahun='';
$input=fgets($csvIn, 1024);

//  $input= fscanf($csvIn, $format, $nrp, $mk, $nilai, $semester, $tahun); //baca per baris
//    echo "hasil nrp=$nrp mk=$mk nilai=$nilai semester=$semester tahun=$tahun \n";
}
$con->commit();
fclose($csvIn);

function ambildata($input, &$nrp, &$mk, &$nilai, &$semester, &$tahun) {
  $nrp=substr($input,1,7);
  $mk=substr($input,9,6);
  $nilai=substr($input,16,2);
  $semester=substr($input,22,5);
  $tahun=substr($input,31,9);
}
