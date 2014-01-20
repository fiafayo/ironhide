<?php
echo "Bismillah ... \n";
$limit=''; // limit 10';
//$fmhs=fopen("mahasiswa.csv","w") or die ("Gagal menulis output ke file CSV \n");
//$fjson=fopen("mahasiswa.json","w") or die ("Gagal menulis output ke file CSV \n");
$delimiter=';';
$enclosure='"';
$dbuser='teknik';
$dbname='baak';
$dbhost='neon.ubaya.ac.id';
$dbpass='prnfuFyBaHvV3dT5';

$dbuser2='ftubaya';
$dbname2='ftubaya_20112';
$dbhost2='localhost';
$dbpass2='sugianto';
 

$con=mysql_connect($dbhost, $dbuser, $dbpass, true) or  die("Gagal koneksi mysql ke $dbhost \n");
mysql_select_db($dbname, $con);

$ft=fopen("transkrip_transfer.csv","w"); 


     //SEKARANG AMBIL TRANSKRIPNYA
    //$ft=fopen("transkrip_".$digitJurusan.".csv","a");
    $sql3= 
            "SELECT NRP,ThnAkademik,Semester,KodeMK,KodeNisbi FROM MhsTranskrip  WHERE (substring(NRP,1,1)='6') AND ((substring(NRP,2,1)='0') OR (substring(NRP,2,1)='1')) AND (substring(NRP,5,1)='7') ORDER BY NRP,ThnAkademik,Semester,KodeMK,KodeNisbi" 
        ;
    $rs3=mysql_query($sql3)  or die("\nGagal eksekusi SQL $sql3  karena ".mysql_error()."\n");
    while ($trow = mysql_fetch_assoc($rs3)) {
        fputcsv($ft, $trow, $delimiter, $enclosure);
        echo $trow['NRP']."\n"; 

    }
    

    mysql_free_result($rs3);


//$json=json_encode($rows);KodeNisbi
//file_put_contents("mahasiswa.json", $json);
fclose($ft);
//fclose($fmhs);
//fclose($ferr);
mysql_close();
echo "\nAlhamdulillah, done \n";

?>
