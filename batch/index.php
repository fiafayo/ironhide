<?php


require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('depan', 'dev', true);

echo "initialize database manager...\n";
$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->initialize($configuration);
$ruangs=RuangPeer::doSelect(new Criteria);
$sql=array();
foreach ($ruangs as $ruang)
{
    $kode=$ruang->getKodeRuang();
    $kodeBaru=str_replace('.', '', $kode);
    if ($kode!=$kodeBaru)
    {
        $sql[]="UPDATE tk_ruang set kode_ruang='$kodeBaru' where kode_ruang='$kode';";
        echo '+';
    } else {
        echo '.';
    }

}
echo "  done\n";
$data=join("\n",$sql);
file_put_contents('/tmp/update_ruang.sql', $data);