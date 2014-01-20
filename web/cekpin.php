<?php
$result=array('kode'=>0, 'msg'=>'FAIL');

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('depan', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
 
$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->initialize($configuration);

$n=$_REQUEST['n'];
$p=$_REQUEST['p'];
$k=$_REQUEST['k'];

$keyAll=md5($n.'ftubaya'.$p);
$indices=array(2,3,5,7,11,13);
$key='';
foreach ($indices as $idx) {
    $key.=substr($keyAll,$idx-1,1);
}

if ($k==$key) {

    $c=new Criteria();
    $c->add(BaakMahasiswaPeer::NRP, $n );
    $c->add(BaakMahasiswaPeer::PIN, $p );
    $mhs=BaakMahasiswaPeer::doSelectOne($c);
    if ($mhs) {
        $result['kode']=1;
        $result['msg']='OK';
    }
} else {
    $result['msg']="WRONG KEY $k instead of $key from $keyAll";
}

echo json_decode($result);