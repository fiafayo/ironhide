<?php
$pesertas = array('6084009','6084071','6094010','6094030','6094033','6094814','6097009','6104001','6104810','6104811','6104813','6104820','6104822','6104823','6104824','6104825','6104826','6104831','6104833','6104851','6104852','6117009','6117011','6117013','6117022','6117028','6117034','6117039','6117040','6117041','6117043','6117053','6117054','6117704');
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');
$configuration = ProjectConfiguration::getApplicationConfiguration('depan', 'dev', true);
echo "initialize database manager...\n";
$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->initialize($configuration);



    $c=new Criteria();
    $c->clearSelectColumns()->clearGroupByColumns();
    $c->addSelectColumn( DaftarKelasPeer::KODE_KELAS );
    $c->setDistinct();
    $c->add(DaftarKelasPeer::NRP, $pesertas, Criteria::IN);
    $c->add(DaftarKelasPeer::STATUS, 1);
    $stmt=DaftarKelasPeer::doSelectStmt($c);
    $kodeKelass = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        $kodeKelass[]=$row['KODE_KELAS'];
        
    }
 

    $c=new Criteria();
    $c->clearSelectColumns()->clearGroupByColumns();
    $c->addSelectColumn( JadwalKuliahPeer::HARI );
    $c->addSelectColumn( JadwalKuliahPeer::JAM_MASUK );
    $c->addSelectColumn( JadwalKuliahPeer::JAM_KELUAR );
    $c->setDistinct();
    $c->add(JadwalKuliahPeer::KODE_KELAS, $kodeKelass, Criteria::IN);
     
    $stmt=JadwalKuliahPeer::doSelectStmt($c);
    $jadwals = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        $jadwals[]=$row['HARI'].'|'.$row['JAM_MASUK'].'|'.$row['JAM_KELUAR'];        
    }
     
    
    
?>
<html>
    <body>
        <ul>
 <?php
 sort($jadwals);
 foreach ($jadwals as $jadwal) {
     echo "<li>$jadwal</li>";
 }
 ?>
        </ul>
    </body>
</html>