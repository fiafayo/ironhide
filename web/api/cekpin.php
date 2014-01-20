<?php
$result=array('kode'=>0, 'msg'=>'FAIL');

require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('depan', 'dev', false);
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

//TEST DATA pin=18839727  nrp=6128083  md5('6128083ftubaya18839727') = 611719f80a86708110bb7336a7c6a2dd
//611719f80a86708110bb7336a7c6a2dd
// 23 5 7   1123

//key=111f87