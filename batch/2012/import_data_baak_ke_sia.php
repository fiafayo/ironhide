<?php
echo "Bismillah\n";
$SIA_USER_DB="s14";
$SIA_PASS_DB="s1smik0208";
$SIA_DB="s14_teknik_npk";
$SIA_HOSTNAME="localhost";

$BAK_USER_DB="teknik";
$BAK_PASS_DB="prnfuFyBaHvV3dT5";
$BAK_DB="baak";
$BAK_HOSTNAME="neon.ubaya.ac.id";

$kodeJurusans=array(
    0=>'A','B','C','D','E','F','G','H','I','J'
);

$fout=fopen("INSERT_MASTER_MHS.sql","w");

$bCon=  mysql_connect($BAK_HOSTNAME, $BAK_USER_DB, $BAK_PASS_DB, true) or die("Gagal koneksi DB ke $BAK_HOSTNAME");
mysql_select_db($BAK_DB, $bCon);
$sCon=  mysql_connect($SIA_HOSTNAME, $SIA_USER_DB, $SIA_PASS_DB, true)  or die("Gagal koneksi DB ke $SIA_HOSTNAME");
mysql_select_db($SIA_DB, $sCon);

$sqlBak = "SELECT NRP,Pin,Nama,KodeStatus,IPKTanpaE,IPSAkhir,SksMaxDepan,SKSKumTanpaE FROM Mahasiswa WHERE substring(NRP,1,3) in ('611','612','610') ORDER BY NRP DESC " ;
$rs=  mysql_query($sqlBak, $bCon);
$row=  mysql_fetch_assoc($rs);
while ($row) {
    $nrp=$row['NRP'];
    
    $sqlCek = "SELECT count(*) AS jml FROM master_mhs WHERE NRP='$nrp'";
    $rsCek=mysql_query($sqlCek);
    $rowCek=mysql_fetch_array($rsCek);
    if ( !$rowCek[0] ) {
        $sqlIns="INSERT INTO master_mhs(NRP,SKSMAX,IPS,STATUS,JURUSAN,NAMA,IPK,SKSKUM,PASSWORD) VALUES ('%s',%s,%s,'%s','%s','%s',%s,%s,'%s')";
        $kodeJur=substr($nrp,3,1);
        $kodeJurusan = isset( $kodeJurusans[$kodeJur] ) ? '6'.$kodeJurusans[$kodeJur] : '60';
        $sql=sprintf($sqlIns, $row['NRP'],$row['SksMaxDepan'],  floatval($row['IPSAkhir']),$row['KodeStatus'],$kodeJurusan,$row['Nama'],floatval($row['IPKTanpaE']),floatval($row['SKSKumTanpaE']),$row['Pin'] ) ;
        $rsIns=mysql_query( $sql );
        fwrite($fout,$sql.";\n");

        echo "$nrp +\n";
    } else {
        echo "$nrp -\n";
    }
    $row=  mysql_fetch_assoc($rs);
}
fclose($fout);
echo "Alhamdulillah\n"; 


?>
