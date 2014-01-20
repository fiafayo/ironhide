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
$dbname2='ftubaya_20131';
$dbhost2='localhost';
$dbpass2='sugianto';

$con=mysql_connect($dbhost, $dbuser, $dbpass, true) or  die("Gagal koneksi mysql ke $dbhost \n");
mysql_select_db($dbname, $con);

$con2=mysql_connect($dbhost2, $dbuser2, $dbpass2, true) or  die("Gagal koneksi mysql ke $dbhost2 \n");
mysql_select_db($dbname2, $con2);

$sql="SELECT NRP,Nama,Pin,KodeStatus,IPKDenganE,IPKTanpaE,IPSAkhir,SksMaxDepan,SKSKumTanpaE FROM Mahasiswa WHERE 
(
(substring(NRP,1,3)='606') OR (substring(NRP,1,3)='607') OR
(substring(NRP,1,3)='608') OR (substring(NRP,1,3)='609') OR
(substring(NRP,1,3)='610') OR (substring(NRP,1,3)='611') OR
(substring(NRP,1,3)='612') OR (substring(NRP,1,3)='613')  
)

AND (KodeStatus NOT IN ('DO','PO','L'))  ORDER BY NRP DESC $limit";
$sqlu="UPDATE tk_mhs SET nama='%s',ips=%s,  ipk=%s, skskum=%s, sksmax=%s, status='%s', password='%s' WHERE nrp='%s'";
$sqli="INSERT INTO tk_mhs(nrp,nama,ips,ipk,skskum,sksmax,status,password,jurusan) VALUES ('%s','%s',%s,%s,%s,%s,'%s','%s','%s')";

echo "Querying ... \n";
$rs=mysql_query($sql, $con);
$rows=array();
$ferr=fopen( date("YmdHis")."_error.log","w");
 
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

 
}

//$json=json_encode($rows);KodeNisbi
//file_put_contents("mahasiswa.json", $json);
 
fclose($fmhs);
fclose($ferr);
mysql_close();
echo "\nAlhamdulillah, done \n";

?>
