<?php
/**
 * 
 *   baak:
    class:        sfPropelDatabase
    param:
      classname:  PropelPDO
      dsn:        mysql:dbname=baak;host=neon.ubaya.ac.id
      username:   teknik
      password:   prnfuFyBaHvV3dT5
      encoding:   utf8
      persistent: true
      pooling:    true
 * 
 */

$databaseFT="baak";
$hostFT="neon.ubaya.ac.id";
$userFT="teknik";
$passFT="prnfuFyBaHvV3dT5";
$connFT=mysql_connect($hostFT,$userFT,$passFT,true) or die("Error");
mysql_select_db($databaseFT,$connFT) or die("database tidak ada");

/**
 * 'NRP': { type: VARCHAR, size: 12, phpName: 'NRP', required: true, primaryKey: true }
    'Pin': { type: VARCHAR, size: 125, phpName: 'Pin', required: true  }
    'Nama': { type: VARCHAR, size: 40, phpName: 'Nama', required: true }
    'KodeStatus': { type: VARCHAR, size: 3, phpName: 'KodeStatus', required: true }
    'IPKDenganE': { type: FLOAT, phpName: 'IPKDenganE', required: true }
    'IPKTanpaE': { type: FLOAT, phpName: 'IPKTanpaE', required: true }
    'IPSAkhir': { type: FLOAT, phpName: 'IPSAkhir', required: true }
    'SksMaxDepan': { type: SMALLINT, phpName: 'SksMaxDepan', required: true }
    'SKSKumTanpaE'
 */ 

$fieldNames = array ('NRP', 'Nama',  'KodeStatus','IPKDenganE','IPKTanpaE','IPSAkhir','SksMaxDepan','SKSKumTanpaE');
$sqlSelect = "SELECT NRP, Nama,  KodeStatus,IPKDenganE,IPKTanpaE,IPSAkhir,SksMaxDepan,SKSKumTanpaE FROM Mahasiswa WHERE NRP LIKE '612%' ORDER BY NRP";

$rsFT = mysql_query($sqlSelect, $connFT);
$mhsFT = mysql_fetch_assoc($rsFT);

$flog=fopen('maharu_2012.csv',"w");
fputcsv($flog, $fieldNames, ',','"');
while ($mhsFT) {
    $nrp=$mhsFT['NRP'];
    fputcsv($flog, $mhsFT, ',','"');
    
    $mhsFT = mysql_fetch_assoc($rsFT);
     
}
fclose($flog);
?>