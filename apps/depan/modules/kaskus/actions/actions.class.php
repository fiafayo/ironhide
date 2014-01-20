<?php

/**
 * kaskus actions.
 *
 * @package    perwalianft
 * @subpackage kaskus
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class kaskusActions extends sfActions
{
    
 private function getKursiKosong($kodeKelas, $kapasitas) {
//     $con=Propel::getConnection();
//     $stmt=$con->prepare("SELECT COUNT(nrp) FROM tk_daftar_kls WHERE status=1 and kode_kelas='$kodeKelas'");
//     $rs=$stmt->execute();
     
     
     $c=new Criteria();
     $c->add( DaftarKelasPeer::STATUS, 1 );
     $c->add( DaftarKelasPeer::KODE_KELAS, $kodeKelas );
     $n=DaftarKelasPeer::doCount($c);
     
     $kk=$kapasitas - $n;
     return $kk;
     
 }   
    
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    
    
    
  public function executeIndex(sfWebRequest $request)
  {
     $this->getResponse()->addJavascript('jquery-1.3.2.min.js');
     $c=new Criteria();
     $c->addAscendingOrderByColumn(JurusanPeer::KODE_JUR);
     $this->jurusans=JurusanPeer::doSelect($c);
     
  }
  
  public function executeUpdate(sfWebRequest $request)
  {
     $baru=strtoupper($this->getRequestParameter('baru'));
     $nrp=strtoupper($this->getRequestParameter('nrp'));
     $lama=strtoupper($this->getRequestParameter('lama'));
     $namaHaris = DataFormatter::getDayNames();
     
     $c=new Criteria();
     $c->add( KelasMKPeer::KODE_KELAS, $lama.'%', Criteria::LIKE );
     $kelasLama=  KelasMKPeer::doSelectOne($c);        
     $this->forward404Unless($kelasLama,"kelas yang dibatalkan tidak valid");
     
     
     $c=new Criteria();
     $c->add( KelasMKPeer::KODE_KELAS, $baru );
     $kelasBaru=  KelasMKPeer::doSelectOne($c);        
     $this->forward404Unless($kelasBaru,"kelas pengganti tidak valid");
     
     $mhs=MahasiswaPeer::retrieveByPK($nrp);
     
     $this->forward404Unless($mhs,"Nrp tidak valid");
     
     $con=Propel::getConnection();
     $kodeKelasLama=$kelasLama->getKodeKelas();
     $kodeKelasBaru=$kelasBaru->getKodeKelas();
     
     $c=new Criteria();
     $c->add( DaftarKelasPeer::NRP, $nrp  );
     $c->add(DaftarKelasPeer::KODE_KELAS, $kodeKelasLama);
     $lama=DaftarKelasPeer::doSelectOne($c);
     if ($lama) {
         $lama->setStatus(3);
         $lama->save();
     }
     
     $c=new Criteria();
     $c->add( DaftarKelasPeer::NRP, $nrp  );
     $c->add(DaftarKelasPeer::KODE_KELAS, $kodeKelasBaru);
     $baru=DaftarKelasPeer::doSelectOne($c);
     if (!$baru) {
         $baru=new DaftarKelas();
         $baru->setNrp($nrp);
         $baru->setKodeKelas($kodeKelasBaru);
         $baru->setKodeFpp(sfConfig::get('app_kaskus_kode','KK12GE'));
     }
      
     $baru->setStatus(1);
     $baru->save();
     $sf_user=$this->getUser();
     UserLogPeer::appendLog($sf_user->getId(), 'kasus_khusus', $nrp.';'.$kodeKelasLama.';'.$kodeKelasBaru);
     $this->row=array(
         'data'=>array(
             'masalah'=>'Data sudah tersimpan'
         )
     ); 
     
 
  }
  
  
  public function executeBatal(sfWebRequest $request)
  {
      
     $nrp=strtoupper($this->getRequestParameter('nrp'));
     $lama=strtoupper($this->getRequestParameter('lama'));
     $namaHaris = DataFormatter::getDayNames();
     
     $c=new Criteria();
     $c->add( KelasMKPeer::KODE_KELAS, $lama.'%', Criteria::LIKE );
     $kelasLama=  KelasMKPeer::doSelectOne($c);        
     $this->forward404Unless($kelasLama,"kelas yang dibatalkan tidak valid");
     
      
     
     $mhs=MahasiswaPeer::retrieveByPK($nrp);
     
     $this->forward404Unless($mhs,"Nrp tidak valid");
     
     $con=Propel::getConnection();
     $kodeKelasLama=$kelasLama->getKodeKelas();
      
     
     $c=new Criteria();
     $c->add( DaftarKelasPeer::NRP, $nrp  );
     $c->add(DaftarKelasPeer::KODE_KELAS, $kodeKelasLama);
     $lama=DaftarKelasPeer::doSelectOne($c);
     if ($lama) {
         $lama->setStatus(3);
         $lama->save();
     }
      
     $sf_user=$this->getUser();
     UserLogPeer::appendLog($sf_user->getId(), 'batal_kaskus', $nrp.';'.$kodeKelasLama);
     $this->row=array(
         'data'=>array(
             'masalah'=>'Data sudah tersimpan'
         )
     ); 
     
 
  }  
  
  public function executeGetMk(sfWebRequest $request)
  {
     $kode=strtoupper($this->getRequestParameter('baru'));
     $nrp=strtoupper($this->getRequestParameter('nrp'));
     $ganti=strtoupper($this->getRequestParameter('lama'));
     
     $mhs=  MahasiswaPeer::retrieveByPK($nrp);
     
     
     $namaHaris = DataFormatter::getDayNames();
     $c=new Criteria();
     $c->add( KelasMKPeer::KODE_KELAS, $kode.'%', Criteria::LIKE );
     $kelasMk=  KelasMKPeer::doSelectJoinMataKuliah($c);        
     $row=array(
         'data'=>array()
     ); 
     
     $c=new Criteria();
     $c->add(JadwalUjianPeer::KODE_MK, substr($kode,0,6) );      
     $ju=  JadwalUjianPeer::doSelectOne($c);
     $jadwalUjian=$ju->toArray(BasePeer::TYPE_FIELDNAME);
     $jadwalUjianText=$namaHaris[$jadwalUjian['hari'] ].' ke-'.$jadwalUjian['minggu'].' jam ke-'.$jadwalUjian['jam'];  
     
     
     
     $c=new Criteria();
     $c->add(JadwalKuliahPeer::KODE_KELAS, $kode );
     $c->addAscendingOrderByColumn(JadwalKuliahPeer::HARI);
     $c->addAscendingOrderByColumn(JadwalKuliahPeer::JAM_MASUK);
     $jmks=JadwalKuliahPeer::doselect($c);
     $jadwals=array();
     $n=count($jmks);
     $jadwalText='';
     if ($n>1) {
         $jadwalText='<ul>';
         foreach($jmks as $jmk) {
             $jadwalText.='<li>'. $namaHaris[$jmk->getHari()].' '.$jmk->getJamMasuk().'-'.$jmk->getJamKeluar().'</li>' ;
             $jadwals[$jmk->getKodeJadwal()] = $jmk->toArray(BasePeer::TYPE_FIELDNAME);
         }
         $jadwalText.='</ul>';
     } else if ($n==1) {
         foreach($jmks as $jmk) {
             $jadwalText.= $namaHaris[$jmk->getHari()].' '.$jmk->getJamMasuk().'-'.$jmk->getJamKeluar() ;
             $jadwals[$jmk->getKodeJadwal()] = $jmk->toArray(BasePeer::TYPE_FIELDNAME);
         }
     } else {
         $jadwalText='&nbsp;';
     }
      
     
     $row['data']['mk']=array();
     $row['data']['masalah']='';
             
      
     
     
     foreach($kelasMk as $k) {
         
         
         $row['data']['mk'][$k->getKodeKelas()]=
                 array (
                     'nama'=>$k->getMataKuliah()->getNama(),
                     'kode'=>$k->getMataKuliah()->getKodeMk(),
                     'sks'=>$k->getMataKuliah()->getSks(),
                     'kp'=>$k->getKp(),
                     'jadwal'=>$jadwalText,
                     'jadwals'=>$jadwals,
                     'jadwalu'=>$jadwalUjianText,
                     'kap'=>$k->getKapasitas(),
                     'kk'=> $this->getKursiKosong($k->getKodeKelas(), $k->getKapasitas())
                     
                 );
         
     }
     $this->row=$row;
  }
    
  
  public function executeGetMhs(sfWebRequest $request)
  {
     $nrp=$this->getRequestParameter('nrp');
     $mhs=MahasiswaPeer::retrieveByPK($nrp);
     $this->forward404Unless($mhs);
     
     
     
     $c=new Criteria();
     $c->add(DaftarKelasPeer::NRP,$nrp);
     $c->add(DaftarKelasPeer::STATUS, 1);
     $c->addAscendingOrderByColumn(DaftarKelasPeer::KODE_KELAS);
     $dafs=  DaftarKelasPeer::doSelectJoinKelasMK($c);
     
     
     $daftarKelass=array();
     $kodeKelass=array();
     $kodeMks=array();
     $no=1;
     foreach ($dafs as $daf) {
         $namaMk=$daf->getKelasMK()->getMataKuliah()->getNama();
         $sksMk=$daf->getKelasMK()->getMataKuliah()->getSks();
         $kp=$daf->getKelasMK()->getKp();
         $kodeMks[$no]=$daf->getKelasMK()->getKodeMk();
         $kodeKelass[$no++]=$daf->getKodeKelas();
         $daftarKelass[$daf->getKodeKelas()]=array(
             'nama'=>$namaMk,
             'kode'=>$daf->getKelasMK()->getKodeMk(),
             'sks'=>$sksMk,
             'kp'=>$kp,
             'jadwal'=>'',
             'jadwalu'=>'',
             'kap'=>$daf->getKelasMK()->getKapasitas(),
             'kk'=>$this->getKursiKosong($daf->getKodeKelas(), $daf->getKelasMK()->getKapasitas())
         );
         
     }
     
//     $c=new Criteria();
//     $c->addAscendingOrderByColumn(MataKuliahPeer::KODE_MK);
//     $matkuls=  MataKuliahPeer::doSelect($c);
//     $matkulNames=array();
//     foreach($matkuls as $matkul) {
//         $matkulNames[$matkul->getKodeMk()]=$matkul->getNama();
//     }
     
     $c=new Criteria();
     $c->add( KelasJurusanPeer::KODE_JUR, $mhs->getJurusan() );
     $c->addAscendingOrderByColumn(KelasJurusanPeer::KODE_KELAS);
     $kjs=  KelasJurusanPeer::doSelectJoinKelasMK($c);
     $mkKelass=array();
     $no=1;
     foreach ($kjs as $kj) {
         $kmk=$kj->getKelasMK();
         if ($kmk) {
            $thisMk=$kmk->getMataKuliah();
            $mkKelass[$no++]=array(
                'nama'=>$thisMk->getNama(),
                'sks'=>$thisMk->getSks(),
                'kp'=>$kj->getKelasMK()->getKp(),
                'kode'=>$kj->getKodeKelas(),
                'kode_mk'=>$thisMk->getKodeMk(),
            );
         }
         
     }
     
     $c=new Criteria();
     $c->add(JadwalKuliahPeer::KODE_KELAS, $kodeKelass, Criteria::IN);
     $c->addAscendingOrderByColumn(JadwalKuliahPeer::KODE_KELAS);
     $jadwalKuliahs=  JadwalKuliahPeer::doSelect($c);
     $jks=array();
     foreach( $jadwalKuliahs as $jk ) {
         if ( !isset( $jks[$jk->getKodeKelas()] ) ) {
             $jks[$jk->getKodeKelas()] = array();
         }
         $jks[$jk->getKodeKelas()][$jk->getKodeJadwal()]=$jk->toArray(BasePeer::TYPE_FIELDNAME);
     }
     
     $namaHaris = DataFormatter::getDayNames();
     
     $c=new Criteria();
     $c->add(JadwalUjianPeer::KODE_MK, $kodeMks, Criteria::IN );
     $c->addAscendingOrderByColumn(JadwalUjianPeer::KODE_MK);
     $jadwalUjians=  JadwalUjianPeer::doSelectJoinMataKuliah($c);
     $jus=array();
     foreach($jadwalUjians as $ju) {
         $jus[$ju->getKodeMk()]=$ju->toArray(BasePeer::TYPE_FIELDNAME);
     }
     foreach( $daftarKelass as $kodeKelas=>$daf ) {
         $kodeMk=substr($kodeKelas,0,6);
         if ( isset($jus[$kodeMk]) ) {
             $ju=$jus[$kodeMk];
         
             if (isset($daftarKelass[$kodeKelas]) ) {
               $daftarKelass[$kodeKelas]['jadwalu']=$namaHaris[$ju['hari'] ].' ke-'.$ju['minggu'].' jam ke-'.$ju['jam'];                       
             }
         }
     }
             
     
     $jdwText=array();
     foreach ($jks as $kodeKelas=>$arJadwal) {
         $n=count($arJadwal);
         if ($n>1) {
             $jdwText[$kodeKelas]='<ul>';
             foreach($arJadwal as $jdw) {
                 $jdwText[$kodeKelas].='<li>'.$namaHaris[ $jdw['hari'] ].' '.$jdw['jam_masuk'].'-'.$jdw['jam_keluar'].'</li>';
             }
             $jdwText[$kodeKelas].='</ul>';
         }  else if ($n==1) {
             foreach($arJadwal as $jdw) {
                 $jdwText[$kodeKelas]=$namaHaris[ $jdw['hari'] ].' '.$jdw['jam_masuk'].'-'.$jdw['jam_keluar'];
             }
         } else {
             $jdwText[$kodeKelas]='&nbsp;';
         }
         $daftarKelass[$kodeKelas]['jadwal']=$jdwText[$kodeKelas];
     }
     
     $this->row=array(
         
         'data'=> array(
             'mhs'=>$mhs->toArray(BasePeer::TYPE_FIELDNAME),
             'daftar'=>$daftarKelass,
             'kelas'=>$mkKelass,
             'jadwal'=>$jks,
             'kode_kelas'=>$kodeKelass,
             'jadwalu'=>$jus,
             
              
         ) 
     );
//     $this->getResponse()->setContent(
//             json_encode($this->row['data'])
//             );
//     $this->setLayout(false);
//     $this->getResponse()->setContentType('text/plain');
//     $this->getResponse()->setContent(
//             json_encode($row)
//             );
     
     
  }
 
  
}
