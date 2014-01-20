<?php


require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('depan', 'dev', true);

echo "initialize database manager...";
$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->initialize($configuration);
echo "done \n";

$tambahList=array(
    '63B041'=>'63A430',
    '63B051'=>'63A532',
    '63B032'=>'63A330',
);
foreach ( $tambahList as $asal=>$hasil )
{
    $c=new Criteria();
    $c->add(TranskripPeer::KODE_MK,$asal);
    $masters=TranskripPeer::doSelect($c);
    foreach ($masters as $master)
    {
      try{
        $copy=new Transkrip();
        $data=$master->toArray( BasePeer::TYPE_FIELDNAME );
        $copy->fromArray( $data  , BasePeer::TYPE_FIELDNAME);
        $copy->setKodeMk($hasil);
        echo $data['nrp'].'... \n';
        $copy->save();
      } catch (Exception $e) {
      }        
    }
}
echo "done \n";