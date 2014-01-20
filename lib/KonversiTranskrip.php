<?php
class KonversiTranskrip {
    public static function tambahKonversiMK( $tambahList ) {
        $logs=array();
        foreach ( $tambahList as $asal=>$hasil )
        {
            $c=new Criteria();
            $c->add(TranskripAsliPeer::KODE_MK,$asal);
            $masters=TranskripAsliPeer::doSelect($c);
            foreach ($masters as $master)
            {
                try {

                    $copy=new Transkrip();
                    $data=$master->toArray( BasePeer::TYPE_FIELDNAME );
                    $copy->fromArray( $data  , BasePeer::TYPE_FIELDNAME);
                    $copy->setKodeMk($hasil);
                    $copy->setState(1);
                    $copy->save();
                    $logs[]="Tambah $hasil ke nrp=".$data['nrp'];
                } catch (Exception $e) {
                    $logs[]="Skip $hasil ke nrp=".$data['nrp'].', '.$e->getMessage();

                }
            }
        }
        return $logs;
    }
}

?>
