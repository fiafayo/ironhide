<?php


require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('depan', 'dev', true);

echo "initialize database manager...\n";
$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->initialize($configuration);
$penjadwalan=new Penjadwalan();
$penjadwalan->isDebug=TRUE;
$penjadwalan->inisialisasiPilihRuang();
$penjadwalan->inisialisasiPilihDosen();
$errors=array();
$infos=array();

$penjadwalan->pilihRuanganKelas($errors, $infos);
$penjadwalan->pilihRuanganNonKelas($errors, $infos);
$penjadwalan->pilihDosenKaryawan($errors, $infos);



//print_r($penjadwalan->jadwalUjians[11]);
//print_r($penjadwalan->jadwalUjians[12]);
print_r($infos);
//print_r($penjadwalan->dosenKelas);
//print_r($penjadwalan->selectedRuangs);
$penjadwalan->simpanPilihanRuang();

/*
 *
 // example of how to manually hydrate objects
$stmt = AuthorPeer::doSelectStmt(new Criteria());
while($row = $stmt->fetch(PDO::FETCH_NUM)) {
  $a = new Author();
  $a->hydrate($row);
}

// example of how to create array of single column
$stmt = AuthorPeer::doSelectStmt(new Criteria());
$names = array();
while($res = $stmt->fetchColumn(1)) {
  $names[] = $res;
}

 *
 *
 *
 */