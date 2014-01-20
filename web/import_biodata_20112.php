<?php
echo "Bismillah ... \n";
$limit=''; // limit 10';
$fmhs=fopen("mahasiswa.csv","w") or die ("Gagal menulis output ke file CSV \n");
//$fjson=fopen("mahasiswa.json","w") or die ("Gagal menulis output ke file CSV \n");
$delimiter=';';
$enclosure='"';
$dbuser='teknik';
$dbname='baak';
$dbhost='neon.ubaya.ac.id';
$dbpass='prnfuFyBaHvV3dT5';

$dbuser2='ftubaya';
$dbname2='ftubaya_20121';
$dbhost2='localhost';
$dbpass2='sugianto';

$con=mysql_connect($dbhost, $dbuser, $dbpass, true) or  die("Gagal koneksi mysql ke $dbhost \n");
mysql_select_db($dbname, $con);

$con2=mysql_connect($dbhost2, $dbuser2, $dbpass2, true) or  die("Gagal koneksi mysql ke $dbhost2 \n");
mysql_select_db($dbname2, $con2);

$sql="SELECT NRP,Nama,Pin,KodeStatus,IPKDenganE,IPKTanpaE,IPSAkhir,SksMaxDepan,SKSKumTanpaE FROM Mahasiswa WHERE (substring(NRP,1,1)='6') AND ((substring(NRP,2,1)='0') OR (substring(NRP,2,1)='1')) AND (KodeStatus NOT IN ('DO','PO','L')) AND (NRP>'6060000') ORDER BY NRP DESC $limit";
$sqlu="UPDATE tk_mhs SET nama='%s',ips=%s,  ipk=%s, skskum=%s, sksmax=%s, status='%s', password='%s' WHERE nrp='%s'";
$sqli="INSERT INTO tk_mhs(nrp,nama,ips,ipk,skskum,sksmax,status,password,jurusan) VALUES ('%s','%s',%s,%s,%s,%s,'%s','%s','%s')";

echo "Querying ... \n";
$rs=mysql_query($sql, $con);
$rows=array();
$ferr=fopen( date("YmdHis")."_error.log","w");
$ft=fopen("transkrip_all.csv","a");
while ($row = mysql_fetch_assoc($rs)) {
    echo "\n".$row['NRP'].".";
    //fputcsv($fmhs, $row, $delimiter, $enclosure);


    $digitJurusan=substr($row['NRP'],3,1);
    $kodeJur='6'.$digitJurusan.'-6'.$digitJurusan;

    $sqlc="SELECT nrp FROM tk_mhs WHERE nrp='".$row['NRP']."'";
    $rsc=mysql_query($sqlc,$con2);
    $n=mysql_num_rows($rsc);
    mysql_free_result($rsc);
    if ($n) {
        $sql2=sprintf($sqlu,
                $row['Nama'],
                floatval($row['IPSAkhir']),
                floatval($row['IPKTanpaE']),
                floatval($row['SKSKumTanpaE']),
                floatval($row['SksMaxDepan']),
                $row['KodeStatus'],
                $row['Pin'],
                $row['NRP']
                );
    } else {
        
        
        $sql2=sprintf($sqli,
                $row['NRP'],
                $row['Nama'],
                floatval($row['IPSAkhir']),
                floatval($row['IPKTanpaE']),
                floatval($row['SKSKumTanpaE']),
                floatval($row['SksMaxDepan']),
                $row['KodeStatus'],
                $row['Pin'],
                $kodeJur
                );
        echo '+';
    }
    try {
       $rs2=mysql_query($sql2, $con2) ;

    } catch ( Exception $e ) {

        fwrite($ferr,  "Gagal eksekusi SQL $sql2 karena ".mysql_error($con2)."\n");
        echo "\nGagal eksekusi SQL $sql2 karena ".mysql_error($con2)."\n";
    }




     //SEKARANG AMBIL TRANSKRIPNYA
    //$ft=fopen("transkrip_".$digitJurusan.".csv","a");
    $sql3=sprintf(
            "SELECT NRP,ThnAkademik,Semester,KodeMK,KodeNisbi FROM MhsTranskrip WHERE NRP='%s' ORDER BY ThnAkademik,Semester,KodeMK,KodeNisbi",
            $row['NRP'] )
        ;
    $rs3=mysql_query($sql3, $con)  or die("\nGagal eksekusi SQL $sql3  karena ".mysql_error($con)."\n");
    while ($trow = mysql_fetch_assoc($rs3)) {
        fputcsv($ft, $trow, $delimiter, $enclosure);
        $sqlc="SELECT nilai FROM tk_transkrip_asli WHERE nrp='%s' AND tahun='%s' AND semester='%s' AND kode_mk='%s'";
        $tahun1=intval($trow['ThnAkademik']);
        $tahun2=$tahun1+1;
        $sqlc=sprintf($sqlc, $trow['NRP'], $tahun1.'-'.$tahun2, substr($trow['Semester'],0,5), $trow['KodeMK'] );
        $rsc=mysql_query( $sqlc, $con2)
                 or die("\nGagal eksekusi SQL $sqlc karena ".mysql_error($con2)."\n");
        $n=mysql_num_rows($rsc);
        mysql_free_result($rsc);
        if ($n) {
            $sql2=sprintf("UPDATE  tk_transkrip_asli SET nilai='%s' WHERE nrp='%s' AND tahun='%s' AND semester='%s' AND kode_mk='%s'",
                $trow['KodeNisbi'],  $trow['NRP'], $tahun1.'-'.$tahun2, $trow['Semester'], $trow['KodeMK'] );

        } else {
            $sql2=sprintf("INSERT INTO  tk_transkrip_asli (nilai,nrp,tahun,semester,kode_mk) values ('%s','%s','%s','%s','%s')",
                $trow['KodeNisbi'],  $trow['NRP'], $tahun1.'-'.$tahun2, $trow['Semester'], $trow['KodeMK'] );
        }
        //$rs2=mysql_query($sql2, $con2)  or die("\nGagal eksekusi SQL $sql2 karena ".mysql_error($con2)."\n");
        try {
            $rs2=mysql_query($sql2, $con2) ;


            $sql2=str_replace('tk_transkrip_asli', 'tk_transkrip', $sql2);
            $rs2=mysql_query($sql2, $con2) ;


        } catch ( Exception $e ) {

            fwrite($ferr,  "Gagal eksekusi SQL $sql2 karena ".mysql_error($con2)."\n");
            echo "\nGagal eksekusi SQL $sql2 karena ".mysql_error($con2)."\n";
        }

    }
    

    mysql_free_result($rs3);
}

//$json=json_encode($rows);KodeNisbi
//file_put_contents("mahasiswa.json", $json);
fclose($ft);
fclose($fmhs);
fclose($ferr);
mysql_close();
echo "\nAlhamdulillah, done \n";

?>
