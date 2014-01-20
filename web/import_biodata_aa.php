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

$dbuser2='advisor';
$dbname2='advisor_2012';
$dbhost2='localhost';
$dbpass2='advisor_345';

$con=mysql_connect($dbhost, $dbuser, $dbpass, true) or  die("Gagal koneksi mysql ke $dbhost \n");
mysql_select_db($dbname, $con);

$con2=mysql_connect($dbhost2, $dbuser2, $dbpass2, true) or  die("Gagal koneksi mysql ke $dbhost2 \n");
mysql_select_db($dbname2, $con2);

$mahasiswaFields = array(
	'NRP',
	'Nama',
	'Fakultas',
	'Jurusan',
	'Alamat',
	'NoTelp',
	'Email',
	'Password',
	'Status'
);

$sql="SELECT NRP,Nama,Pin,KodeStatus,IPKDenganE,IPKTanpaE,IPSAkhir,SksMaxDepan,SKSKumTanpaE FROM Mahasiswa WHERE (substring(NRP,1,1)='6') AND ((substring(NRP,2,1)='0') OR (substring(NRP,2,1)='1')) AND (KodeStatus NOT IN ('DO','PO','L'))  ORDER BY NRP DESC $limit";
$sqlu="UPDATE mahasiswa SET Nama='%s', Password='%s' WHERE NRP='%s'";
$sqli="INSERT INTO mahasiswa(NRP,Nama,password,fakultas,jurusan) VALUES ('%s','%s','%s',6,%s)";

echo "Querying ... \n";
$rs=mysql_query($sql, $con);
$rows=array();
$ferr=fopen( date("YmdHis")."_error.log","w");

while ($row = mysql_fetch_assoc($rs)) {
    echo "\n".$row['NRP'].".";
    fputcsv($fmhs, $row, $delimiter, $enclosure);


    $digitJurusan=substr($row['NRP'],3,1);


    $sqlc="SELECT NRP FROM mahasiswa WHERE NRP='".$row['NRP']."'";
    $rsc=mysql_query($sqlc,$con2);
    $n=mysql_num_rows($rsc);
    mysql_free_result($rsc);
    if ($n) {
        $sql2=sprintf($sqlu,
                $row['Nama'],

                $row['Pin'],
                $row['NRP']
                );
    } else {
        
        
        $sql2=sprintf($sqli,
                $row['NRP'],
                $row['Nama'],
                $row['Pin'],
                $digitJurusan
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
