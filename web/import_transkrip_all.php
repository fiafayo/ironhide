<?php
echo "Bismillah ... \n";
$limit='';// limit 10';
//$fmhs=fopen("mahasiswa.csv","w") or die ("Gagal menulis output ke file CSV \n");
//$fjson=fopen("mahasiswa.json","w") or die ("Gagal menulis output ke file CSV \n");
$delimiter=';';
$enclosure='"';
$dbuser='teknik';
$dbname='baak';
$dbhost='neon.ubaya.ac.id';
$dbpass='prnfuFyBaHvV3dT5';

$dbuser2='ftubaya';
$dbname2='ftubaya_20122';
$dbhost2='localhost';
$dbpass2='sugianto';
 

$con=mysql_connect($dbhost, $dbuser, $dbpass, true) or  die("Gagal koneksi mysql ke $dbhost \n");
mysql_select_db($dbname, $con);

$con2=mysql_connect($dbhost2, $dbuser2, $dbpass2, true) or  die("Gagal koneksi mysql ke $dbhost2 \n");
mysql_select_db($dbname2, $con2);
 


     //SEKARANG AMBIL TRANSKRIPNYA
    //$ft=fopen("transkrip_".$digitJurusan.".csv","a");
    $sql3="SELECT NRP,ThnAkademik,Semester,KodeMK,KodeNisbi FROM MhsTranskrip  WHERE (substring(NRP,1,1)='6') AND ((substring(NRP,2,1)='0') OR (substring(NRP,2,1)='1')) ORDER BY NRP DESC,ThnAkademik,Semester,KodeMK,KodeNisbi $limit"        ;
    $sqlIns = "INSERT INTO tk_transkrip(nrp,tahun,semester,kode_mk,nilai) VALUES ('%s','%s','%s','%s','%s')";
    $sqlUpd = "UPDATE tk_transkrip SET nilai='%s' WHERE nrp='%s' AND tahun='%s' AND semester='%s' AND kode_mk='%s'"; 
    $rs3=mysql_query($sql3,$con)  or die("\nGagal eksekusi SQL $sql3  karena ".mysql_error()."\n");
    $ft = fopen("transkrip_asli.sql","w");
    while ($trow = mysql_fetch_assoc($rs3)) {         
        echo $trow['NRP'];
        $tahunAkademik = intval($trow['ThnAkademik']);
        $tahunAkademik = $tahunAkademik .'-'. ($tahunAkademik+1);
        try {
            $sqlText = sprintf( $sqlIns, $trow['NRP'],$tahunAkademik ,$trow['Semester'],$trow['KodeMK'],$trow['KodeNisbi']);
            fwrite($ft,$sqlText.";\n");
            $bisa=mysql_query( $sqlText, $con2 ) ; 
            if ($bisa===false) {
                $sqlText=sprintf($sqlUpd,$trow['KodeNisbi'], $trow['NRP'],$tahunAkademik ,$trow['Semester'],$trow['KodeMK']);
                mysql_query( $sqlText, $con2 ) ; 
                echo "*";
            } else {
                echo "+";
            }
            echo " done \n";
        } catch ( Exception $e ) {
            echo " FAIL karena ".$e->getMessage()."\n";
        }
    }
    fclose($ft);

    mysql_free_result($rs3);


//$json=json_encode($rows);KodeNisbi
//file_put_contents("mahasiswa.json", $json);

//fclose($fmhs);
//fclose($ferr);
mysql_close();
echo "\nAlhamdulillah, done \n";

?>
