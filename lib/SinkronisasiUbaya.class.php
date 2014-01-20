<?php
class SinkronisasiUbaya
{
    public static $statusNames=array(
        'A'=>'Aktif',
        'DX' => 'Calon DO karena evaluasi studi I atau II',
        'MS' => 'Calon DO karena masa studi habis',
        'PDX' => 'Calon DO karena kena evaluasi studi dan tidak bayar',
        'PX' => 'Calon DO karena tidak bayar 2 semester berturut',
        'TD'=>'Tilang Keuangan',
        'TS'=>'Tilang Keuangan',
        'TU'=>'Tilang Keuangan',
    );
    public static function getStatusMhs($nrp)
    {
        $info='';
        try {
            $url=sfConfig::get('app_url_mhs_status','http://poodle.ubaya.ac.id/sia/webx/mhsstatus.php');
            $nrp64 = base64_encode($nrp);
            $hasil=file_get_contents($url.'?nrp='.$nrp64);
            $hasilU=strtoupper($hasil);
            if ( substr($hasilU,0,3) == 'OK=' ){
                $info64=substr($hasil,3);
                $info=base64_decode($info64);
                sfContext::getInstance()->getLogger()->debug("BERHASIL mendapatkan data untuk nrp=$nrp yaitu <br/>base64='$info64'  <br/>text asli='$info'");
            } else {
                sfContext::getInstance()->getLogger()->debug( "Gagal mendapatkan data untuk nrp=$nrp via url=".$url.'?nrp='.$nrp64.' response='.$info64);
            }
        } catch (Exception $e) {

        }
        return $info;
    }

 

    public static function getBaakMahasiswa($nrp,$pin)
    {
        $pindahJurusanList=array('6089802','6089801');
        $mhs=null;
        $bmhs=BaakMahasiswaPeer::retrieveByPK($nrp);
        if ($bmhs) {
          if ($bmhs->getPin()==$pin )
          {
            $mhs=MahasiswaPeer::retrieveByPK($nrp);
            if (!$mhs)
            {
                $mhs=new Mahasiswa();
                $mhs->setNrp($nrp);


            }
            if ( !in_array($nrp, $pindahJurusanList) )
            {
                if ( trim($mhs->getJurusan())=='' )
                {
                    $kodeJur=substr($nrp,3,1);
                    $kodeJur='6'.$kodeJur.'-'.'6'.$kodeJur;
                    $mhs->setJurusan($kodeJur);
                }
            }

            $mhs->setIpk( $bmhs->getIPKTanpaE() );
            $mhs->setIps( $bmhs->getIPSAkhir() );
            $mhs->setSksmax( $bmhs->getSksMaxDepan() );
            $mhs->setPassword( $bmhs->getPin() );
            $status=trim($bmhs->getKodeStatus());

            //if (in_array($status, array('A' ))) $status='';
            if ($status=='')
            {
                $status='ZZ';
            }
            $mhs->setStatus( $status );
            $mhs->setNama( $bmhs->getNama() );
            $mhs->setSkskum($bmhs->getSKSKumTanpaE());
            $mhs->save();
          }

        }
        return $mhs;
    }
    public static function sinkronisasiSemuaMahasiswa(&$logs)
    {
        $c=new Criteria;
        $c->add(BaakMahasiswaPeer::NRP,'6%',Criteria::LIKE);
        $c->add(BaakMahasiswaPeer::KODESTATUS, array('DO','PO'), Criteria::NOT_IN );
        $c->addAscendingOrderByColumn(BaakMahasiswaPeer::NRP);
        $bmhss=BaakMahasiswaPeer::doSelect($c);
        unset($c);
        $n=count($bmhss);
        $logs[]= "Processing $n records ";
        $i=1;
        foreach ($bmhss as $bmhs)
        {
            
            
            $nrp=$bmhs->getNRP();
            $mhs=MahasiswaPeer::retrieveByPK($nrp);
            if (!$mhs)
            {
                $mhs=new Mahasiswa();
                $mhs->setNrp($nrp);
                $logs[]= $i.'/'.$n.'>'."new $nrp ";
                $kodeJur=substr($nrp,3,1);
                $kodeJur='6'.$kodeJur.'-'.'6'.$kodeJur;
                $mhs->setJurusan($kodeJur);
            } else {
                $logs[]= $i.'/'.$n.'>'."upd $nrp ";
            }
            $i++;
            $mhs->setIpk( $bmhs->getIPKTanpaE() );
            $mhs->setIps( $bmhs->getIPSAkhir() );
            $mhs->setSksmax( $bmhs->getSksMaxDepan() );
            $mhs->setPassword( $bmhs->getPin() );
            $status=trim($bmhs->getKodeStatus());
            //if (in_array($status, array('A' ))) $status='';
            if ($status=='')
            {
                $status='ZZ';
            }

            $mhs->setStatus( $status );
            $mhs->setNama( $bmhs->getNama() );
            $mhs->setSkskum($bmhs->getSKSKumTanpaE());
            $mhs->save();
            unset($mhs);
            //echo "\n";
        }
        $logs[]= "done ";
    }
}
?>
