<?php


require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('depan', 'dev', true);

echo "initialize database manager...\n";
$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->initialize($configuration);

Penjadwalan::importJumlahPesertaKeJadwalUjian(true);
