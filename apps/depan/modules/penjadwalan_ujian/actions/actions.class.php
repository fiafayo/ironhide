<?php

/**
 * penjadwalan_ujian actions.
 *
 * @package    perwalianft
 * @subpackage penjadwalan_ujian
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class penjadwalan_ujianActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      return $this->forward('penjadwalan_ujian','petugas');
  }
  public function executeMonitor(sfWebRequest $request) {
      
  }
  public function executeCetak(sfWebRequest $request) {
      $this->penjadwalan = new PenjadwalanUjian();
      $this->penjadwalan->buatDaftarPengajarAktif();
  }
  public function executeExportSiska(sfWebRequest $request) {
      $jenis=$request->getParameter('jenis','UTS');          
      $format=$request->getParameter('format','BeritaAcaraDosen');
      $tglAwal=$request->getParameter('tanggal','2013-10-21');          
      $rows=  PenjadwalanUjian::generateReportUjianKeSiska($jenis, $tglAwal, $format);
      
      $this->setLayout(false);
      $this->getResponse()->setContentType('text/csv');
      $csv='';
      foreach($rows as $row) {
          $csv.=implode(';',$row)."\n";
      }
      return  $this->renderText($csv);
  }
  public function executeCetakTagihanSoal(sfWebRequest $request) {
      $this->penjadwalan = new PenjadwalanUjian();
      $this->penjadwalan->buatDaftarPengajarAktif();
      $kodeDs = $request->getParameter('kodeDosen');
      $tagihans = array();
      if ($kodeDs != 'ALL') {
        $dosen=  DosenPeer::retrieveByPK( $kodeDs );
        $this->forward404Unless($dosen);
        $tagihans[$kodeDs]=array('n'=>$dosen->getNama(), 'd'=>array());
      } else {
          $kodeDosens = array_keys($this->penjadwalan->daftarKelasDosen);
          foreach( $kodeDosens as $kodeDs ) {
              $dosen=  DosenPeer::retrieveByPK( $kodeDs );
              $tagihans[$kodeDs]=array(
                  'n'=> ($dosen) ? $dosen->getNama() : '', 
                  'd'=>array()
                  );
          }
      }
      $kodeDosens=array_keys($tagihans);
      foreach($kodeDosens as $kodeDs) {
        $c=new Criteria();
        $c->add( KelasMKPeer::STATUS_BUKA,1 );
        $c->add(DosenKelasPeer::KODE_DOSEN,$kodeDs);
        $c->addJoin( DosenKelasPeer::KODE_KELAS, KelasMKPeer::KODE_KELAS );
        $c->addJoin(JadwalUjianPeer::KODE_MK, KelasMKPeer::KODE_MK);
        $c->addAscendingOrderByColumn(JadwalUjianPeer::MINGGU);
        $c->addAscendingOrderByColumn(JadwalUjianPeer::HARI);
        $c->addAscendingOrderByColumn(JadwalUjianPeer::JAM);
        $kelass = JadwalUjianPeer::doSelectJoinMataKuliah($c);
        $tagihans[$kodeDs]['d']=$kelass;
      }
      $this->tagihans=$tagihans;
      $this->setLayout(false);
  }
  
  public function executeKaryawanJaga(sfWebRequest $request) {
      $this->penjadwalan = new PenjadwalanUjian();
  }
  public function executeDosenJaga(sfWebRequest $request) {
      $this->penjadwalan = new PenjadwalanUjian();
  }
  public function executeMatkul(sfWebRequest $request) {
      $this->penjadwalan = new PenjadwalanUjian();
  }
  
  public function executeUbahJadwal(sfWebRequest $request) {
      $this->setLayout(false);
      $id=$request->getParameter('id');
      $c=new Criteria();
      $c->add(JadwalUjianPeer::KODE_MK,$id);
       
      $this->jadwal=  JadwalUjianPeer::doSelectOne($c);
      $this->kodeMk=$id;
      
      $c->clear();
      $c->add(MataKuliahPeer::KODE_MK,$id);
      $this->matkul = MataKuliahPeer::doSelectOne($c);
      
  }
  public function executeSimpanUbahJadwal(sfWebRequest $request) {
      $this->setLayout(false);
      
      $kodeUjian=$request->getParameter('kodeUjian');
      $jenisRuang=$request->getParameter('jenisRuang');
      $jenisUjian=$request->getParameter('jenisUjian');
      $c=new Criteria();
      $c->add(JadwalUjianPeer::KODE_UJIAN,$kodeUjian);
      $jadwal=  JadwalUjianPeer::doSelectOne($c);
      if (!$jadwal) {
          return $this->renderText("Jadwal ujian dengan kode $kodeUjian tidak valid!");      
      }
      $jadwal->setJenisRuang($jenisRuang);
      $jadwal->setJenisUjian($jenisUjian);
      $jadwal->save();
      
      return $this->renderText('true');      
  }
  
  public function executeDelDosen(sfWebRequest $request) {
      $id=$request->getParameter('id');
      $dosen=  DosenPeer::retrieveByPK($id);
      $status=404;
      if ($dosen) {
          $dosen->setIsPengawas(0);
          $dosen->save();
          $status=200;
      }
      $text=  json_encode(array('status'=>$status));
      return $this->renderText($text);
  }
  

  public function executeDelKaryawan(sfWebRequest $request) {
      $id=$request->getParameter('id');
      $karyawan=  KaryawanPeer::retrieveByPK($id);
      $status=404;
      if ($karyawan) {
          $karyawan->setIsPengawas(0);
          $karyawan->save();
          $status=200;
      }
      $text=  json_encode(array('status'=>$status));
      return $this->renderText($text);
  }
  public function executeListDosenNonJaga(sfWebRequest $request) {
      $c=new Criteria();
      $c->add(DosenPeer::IS_PENGAWAS,0);
      $c->addAscendingOrderByColumn(DosenPeer::KODE_DOSEN);
      $rows=  DosenPeer::doSelect($c);
      $json=array();
      foreach($rows as $row) {
          $json[]=array(
               'kode'=>$row->getKodeDosen(),
               'nama'=>      $row->getNama()
          );
      }
      return $this->renderText( json_encode($json) );
  }
  public function executeListKaryawanNonJaga(sfWebRequest $request) {
      $c=new Criteria();
      $c->add(KaryawanPeer::IS_PENGAWAS,0);
      $c->addAscendingOrderByColumn(KaryawanPeer::KODE_KARYAWAN);
      $rows=  KaryawanPeer::doSelect($c);
      $json=array();
      foreach($rows as $row) {
          $json[]=array(
               'kode'=>$row->getKodeKaryawan(),
               'nama'=>      $row->getNama()
          );
      }
      return $this->renderText( json_encode($json) );
  }
  
  public function executeAddDosen(sfWebRequest $request) {
      $id=$request->getParameter('id'); 
      $dosen=  DosenPeer::retrieveByPK($id);
      $status=404;
      if ($dosen) {
          $dosen->setIsPengawas(1);
          $dosen->save();
          $status=200;
      }
      $text=  json_encode(array('status'=>$status));
      return $this->renderText($text);
  }  
  public function executeAddKaryawan(sfWebRequest $request) {
      $id=$request->getParameter('id'); 
      $dosen=  KaryawanPeer::retrieveByPK($id);
      $status=404;
      if ($dosen) {
          $dosen->setIsPengawas(1);
          $dosen->save();
          $status=200;
      }
      $text=  json_encode(array('status'=>$status));
      return $this->renderText($text);
  }  
  public function executeRuang(sfWebRequest $request) {
      $this->penjadwalan=new PenjadwalanUjian();
  }  
  public function executeJadwal(sfWebRequest $request) {
      $this->penjadwalan=new PenjadwalanUjian();
    
       
  }  
  public function executePetugas(sfWebRequest $request) {
      $this->penjadwalan=new PenjadwalanUjian();
  }  
  public function executeProses(sfWebRequest $request) {
      $this->penjadwalan=new PenjadwalanUjian();
      //$this->penjadwalan->jalankanProses();
      
  }  
  public function executeUbahRuang(sfWebRequest $request) {
      $id=$this->getRequestParameter('id');
      $id=  str_replace('__', '.', $id);
      $id=  str_replace('_', ' ', $id);
      $this->ruang=  RuangPeer::retrieveByPK($id);
      $this->setLayout(false);
  }
  public function executeSimpanUbahRuang(sfWebRequest $request) {
      $this->setLayout(false);
      $id=$this->getRequestParameter('id');
      $id=  str_replace('__', '.', $id);
      $id=  str_replace('_', ' ', $id);
      $this->ruang=RuangPeer::retrieveByPK($id);
      if ( !$this->ruang ) {
          return $this->renderText("Kode ruang $id tidak valid!");
      }
      $this->ruang->setUntukUjian( $request->getParameter('untuk_ujian',0) );
      $this->ruang->setPrioritas( $request->getParameter('prioritas',0) );
      $this->ruang->setKapasitasUjian( $request->getParameter('kapasitas_ujian',0) );
      $this->ruang->setJenis( $request->getParameter('jenis','KELAS') );
      $this->ruang->save();
      return $this->renderText('true');
      
  }
  
  public function executeLaksanakanProses(sfWebRequest $request) {
      $this->penjadwalan=new PenjadwalanUjian();
      $this->penjadwalan->jalankanProses();
      return $this->forward('penjadwalan_ujian','proses');      
  }
  public function executeSimpanCacheKeDb(sfWebRequest $request) {
      $this->penjadwalan=new PenjadwalanUjian();
      $this->penjadwalan->simpanIsiKelasPerSlotKeDB();
      return $this->forward('penjadwalan_ujian','petugas');      
  }


  public function executeCetakJadwalJagaDosen(sfWebRequest $request) {
      $filename=dirname(__FILE__).'/../../../../../cache/jadwalJagaDosen.yml';
      $cache=$request->getParameter('cache',1); //gunakan cache, atau isi 0 untuk force reload
      if (file_exists($filename) && $cache ) {
          $jadwalJagaDosens = sfYaml::load($filename);
      } else {
          $jadwalJagaDosens=array();
          $c=new Criteria();
          $c->addAscendingOrderByColumn(JadwalRuangPeer::KODE_DOSEN);
          $c->addAscendingOrderByColumn(JadwalRuangPeer::MINGGU);
          $c->addAscendingOrderByColumn(JadwalRuangPeer::HARI);
          $c->addAscendingOrderByColumn(JadwalRuangPeer::JAM);
          $jadwals=  JadwalRuangPeer::doSelectJoinDosen($c);
          foreach($jadwals as $jadwal) {
              $kodeDs = intval($jadwal->getKodeDosen());
              $namaDs = ($jadwal->getDosen())? $jadwal->getDosen()->getNama() : '';
              $kodeRu = $jadwal->getKodeRuang();
              $slot=$jadwal->getMinggu().$jadwal->getHari().$jadwal->getJam();
              if ( !isset( $jadwalJagaDosens[$kodeDs] ) ) {
                  $jadwalJagaDosens[$kodeDs] = array('n'=>$namaDs, 'c'=>0, 'd'=>array());
              }
              $jadwalJagaDosens[$kodeDs]['d'][$slot]=array('r'=>$kodeRu, 'c'=>0, 'm'=>array());
              $details=$jadwal->getJadwalRuangMks();
              foreach($details as $detail) {
                  $kp=$detail->getKp();
                  $kodeMk=$detail->getKodeKelas();
                  $jadwalJagaDosens[$kodeDs]['d'][$slot]['m'][$kodeMk.'_'.$kp]=$detail->getKapasitas();
                  $jadwalJagaDosens[$kodeDs]['d'][$slot]['c']=$jadwalJagaDosens[$kodeDs]['d'][$slot]['c']+1;
                  $jadwalJagaDosens[$kodeDs]['c']=$jadwalJagaDosens[$kodeDs]['c']+1;
              }
          }
          $data = sfYaml::dump($jadwalJagaDosens);
          file_put_contents($filename, $data);
      }
      $this->jadwalJagaDosens=$jadwalJagaDosens;
      $this->setLayout(false);
  }
  

  public function executeCetakJadwalJagaKaryawan(sfWebRequest $request) {
      $filename=dirname(__FILE__).'/../../../../../cache/jadwalJagaKaryawan.yml';
      $cache=$request->getParameter('cache',1); //gunakan cache, atau isi 0 untuk force reload
      if (file_exists($filename) && $cache ) {
          $jadwalJagaDosens = sfYaml::load($filename);
      } else {
          $jadwalJagaDosens=array();
          $c=new Criteria();
          $c->addAscendingOrderByColumn(JadwalRuangPeer::KODE_KARYAWAN);
          $c->addAscendingOrderByColumn(JadwalRuangPeer::MINGGU);
          $c->addAscendingOrderByColumn(JadwalRuangPeer::HARI);
          $c->addAscendingOrderByColumn(JadwalRuangPeer::JAM);
          $jadwals=  JadwalRuangPeer::doSelectJoinKaryawan($c);
          foreach($jadwals as $jadwal) {
              $kodeDs = intval($jadwal->getKodeKaryawan());
              $karyawan=$jadwal->getKaryawan();
              $namaDs = ($karyawan) ? $karyawan->getNama() : '';
              $kodeRu = $jadwal->getKodeRuang();
              $slot=$jadwal->getMinggu().$jadwal->getHari().$jadwal->getJam();
              if ( !isset( $jadwalJagaDosens[$kodeDs] ) ) {
                  $jadwalJagaDosens[$kodeDs] = array('n'=>$namaDs, 'c'=>0, 'd'=>array());
              }
              $jadwalJagaDosens[$kodeDs]['d'][$slot]=array('r'=>$kodeRu, 'c'=>0, 'm'=>array());
              $details=$jadwal->getJadwalRuangMks();
              foreach($details as $detail) {
                  $kp=$detail->getKp();
                  $kodeMk=$detail->getKodeKelas();
                  $jadwalJagaDosens[$kodeDs]['d'][$slot]['m'][$kodeMk.'_'.$kp]=$detail->getKapasitas();
                  $jadwalJagaDosens[$kodeDs]['d'][$slot]['c']=$jadwalJagaDosens[$kodeDs]['d'][$slot]['c']+1;
                  $jadwalJagaDosens[$kodeDs]['c']=$jadwalJagaDosens[$kodeDs]['c']+1;
              }
          }
          $data = sfYaml::dump($jadwalJagaDosens);
          file_put_contents($filename, $data);
      }
      $this->jadwalJagaDosens=$jadwalJagaDosens;
      $this->setLayout(false);
  }
  
  public function executeIsiNrpPerKp(sfWebRequest $request) {
      $this->penjadwalan = new PenjadwalanUjian();
      $this->penjadwalan->isiNrpPerKp();
      return $this->forward('penjadwalan_ujian','cetak');
  }
  public function executeCetakJadwalUjian(sfWebRequest $request) {
      
      $cetak = $request->getParameter('cetak');
      switch ($cetak) {
          case 'berita_acara':
               $this->setTemplate('cetakBeritaAcaraUjian');
          
      }
      $this->penjadwalan = new PenjadwalanUjian();
      
      $filename=dirname(__FILE__).'/../../../../../cache/jadwalUjians.yml';
      $cache=$request->getParameter('cache',1); //gunakan cache, atau isi 0 untuk force reload
      if (file_exists($filename) && $cache ) {
          $jadwalUjians = sfYaml::load($filename);
      } else {
         $jadwalUjians=$this->penjadwalan->generateReportJadwalUjian();
      

         $data = sfYaml::dump($jadwalUjians);
         file_put_contents($filename, $data);
      }
      
      $this->jadwalUjians=$jadwalUjians;
        
      $this->setLayout(false);
  }    
  
  public function executeCetakJadwalUjianUntukPengawas(sfWebRequest $request) {
      $filename=dirname(__FILE__).'/../../../../../cache/jadwalUjians.yml';
      $cache=$request->getParameter('cache',1); //gunakan cache, atau isi 0 untuk force reload
      if (file_exists($filename) && $cache ) {
          $jadwalUjians = sfYaml::load($filename);
      } else {
      
        $c=new Criteria();
        $c->add( KelasMKPeer::STATUS_BUKA,1 );
        $c->addJoin(JadwalUjianPeer::KODE_MK, KelasMKPeer::KODE_MK);
        $c->addAscendingOrderByColumn(JadwalUjianPeer::MINGGU);
        $c->addAscendingOrderByColumn(JadwalUjianPeer::HARI);
        $c->addAscendingOrderByColumn(JadwalUjianPeer::JAM);
        $c->setDistinct();
        $kelass = JadwalUjianPeer::doSelectJoinMataKuliah($c);
        $jadwalUjians = array();
        foreach ($kelass as $kelas) {
          $kodeMk = $kelas->getKodeMk();
          $namaMk = $kelas->getMataKuliah()->getNama();
          $minggu=$kelas->getMinggu();
          $hari=$kelas->getHari();
          $jam=$kelas->getJam();
          
          if ( !isset($jadwalUjians[$minggu]) ) {
              $jadwalUjians[$minggu] = array('c'=>0,'d'=>array());
          }
          if ( !isset($jadwalUjians[$minggu]['d'][$hari]) ) {
              $jadwalUjians[$minggu]['d'][$hari] = array('c'=>0,'d'=>array(),'p'=>'');
          }
          if ( !isset($jadwalUjians[$minggu]['d'][$hari]['d'][$jam]) ) {
              $jadwalUjians[$minggu]['d'][$hari]['d'][$jam] = array('c'=>0,'d'=>array());
          }
          if ( !isset($jadwalUjians[$minggu][$hari]['d'][$jam]['d'][$kodeMk]) ) {
              $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk] = array( 'c'=>0, 'namaMk'=>$namaMk, 'ruangs'=>array() );
          }
          $c->clear();
          $c->add(JadwalRuangPeer::MINGGU,$minggu);
          $c->add(JadwalRuangPeer::HARI,$hari);
          $c->add(JadwalRuangPeer::JAM,$jam);
          $c->addJoin(JadwalRuangMkPeer::JADWAL_RUANG_ID,JadwalRuangPeer::ID);
          $c->add(JadwalRuangMkPeer::KODE_KELAS,$kodeMk);        
          $c->addAscendingOrderByColumn(JadwalRuangMkPeer::KP);
          $ruangs=JadwalRuangMkPeer::doSelectJoinJadwalRuang($c);
          foreach ($ruangs as $ruang) {
              $kodeRuang = $ruang->getJadwalRuang()->getKodeRuang();
              $kodeDosen=$ruang->getJadwalRuang()->getKodeDosen();
              $kodeKaryawan=$ruang->getJadwalRuang()->getKodeKaryawan();
              $kp=$ruang->getKp();
              if ( !isset($jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp]) ) {
                  $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp]=array('c'=>0,'d'=>array());
              }
              $jadwalUjians[$minggu]['c']=$jadwalUjians[$minggu]['c']+1;
              $jadwalUjians[$minggu]['d'][$hari]['c']=$jadwalUjians[$minggu]['d'][$hari]['c']+1;
              $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['c']=$jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['c']+1;
              $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['c']=$jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['c']+1;
              $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp]['c']=
                      $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp]['c']+1;
              $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp]['d'][$kodeRuang]= 
                      array(
                          'i'=>$ruang->getKapasitas(),
                          'b'=>$ruang->getNrpAwal(),
                          'e'=>$ruang->getNrpAkhir(),
                          'd'=>$kodeDosen,
                          'k'=>$kodeKaryawan
                      );
          }

        }
        
          $c=new Criteria();
          $c->addAscendingOrderByColumn(PiketUjianPeer::MINGGU);
          $c->addAscendingOrderByColumn(PiketUjianPeer::HARI);
          $pikets = PiketUjianPeer::doSelectJoinDosen($c);
          foreach($pikets as $piket) {
              $minggu=$piket->getMinggu();
              $hari=$piket->getHari();
              $kodeDos=$piket->getKodeDosen();
              $jadwalUjians[$minggu]['d'][$hari]['p']=
                      $piket->getDosen()->getNama()." ($kodeDos)";
          }        
        
        $data = sfYaml::dump($jadwalUjians);
        file_put_contents($filename, $data);
      }
      $this->jadwalUjians=$jadwalUjians;
        
      $this->setLayout(false);
  }      
  
  public function executeCetakJadwalUjianPengawas(sfWebRequest $request) {
      
      $cetak=$request->getParameter('cetak','jadwal_pengawas');
      switch ($cetak) {
          case 'absensi_penjaga':
              $this->setTemplate('cetakAbsensiPetugasJaga');
              break;
          case 'berita_acara':
              $this->setTemplate('cetakBeritaAcaraUjian');
              break;
          case 'jadwal_pengawas':
          default:
              $this->setTemplate('cetakJadwalUjianPengawas');
      }
      
      $this->penjadwalan=new PenjadwalanUjian();
      $filename=dirname(__FILE__).'/../../../../../cache/jadwalUjianPengawas.yml';
      $cache=$request->getParameter('cache',1); //gunakan cache, atau isi 0 untuk force reload
      if (file_exists($filename) && $cache ) {
          $jadwalUjians = sfYaml::load($filename);
      } else {
      
          $c=new Criteria();
          $c->add( KelasMKPeer::STATUS_BUKA,1 ); 
          $c->addJoin(JadwalRuangMkPeer::JADWAL_RUANG_ID,JadwalRuangPeer::ID);
          $c->addJoin(KelasMKPeer::KODE_MK, JadwalRuangMkPeer::KODE_KELAS); 
          $c->addAscendingOrderByColumn(JadwalRuangPeer::MINGGU);
          $c->addAscendingOrderByColumn(JadwalRuangPeer::HARI);
          $c->addAscendingOrderByColumn(JadwalRuangPeer::JAM);
          $c->addAscendingOrderByColumn(JadwalRuangPeer::KODE_RUANG);
          $c->setDistinct();
//          $c->addAscendingOrderByColumn(JadwalRuangMkPeer::KODE_KELAS);          
          $jadwals=JadwalRuangPeer::doSelect($c);
          foreach ($jadwals as $jadwal) {
          
              $minggu=$jadwal->getMinggu();
              $hari=$jadwal->getHari();
              $jam = $jadwal->getJam();
              $kodeHari=$minggu.$hari;
              $kodeDos=$jadwal->getKodeDosen();
              $kodeKar=$jadwal->getKodeKaryawan();
              $kodeRuang=$jadwal->getKodeRuang();
              $namaDos = ( isset( $this->penjadwalan->dosenReffs[$kodeDos] ) ) ? $this->penjadwalan->dosenReffs[$kodeDos] : '';
              $namaKar = ( isset( $this->penjadwalan->karyawanReffs[$kodeKar] ) ) ? $this->penjadwalan->karyawanReffs[$kodeKar] : '';
                      
              if ( !isset( $jadwalUjians[$kodeHari] ) ) {
                  $jadwalUjians[$kodeHari] = array(
                      'c'=>0,
                      'd'=>array(),
                      'p'=>0,
                  );
              }
              if ( !isset( $jadwalUjians[$kodeHari]['d'][$jam] ) ) {
                  $jadwalUjians[$kodeHari]['d'][$jam] = array(
                      'c'=>0,
                      'd'=>array()
                  );
              }
 
              if ( !isset( $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang] ) ) {
                  $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang] = array(
                      'c'=>0,
                      'dos'=>$kodeDos,
                      'kar'=>$kodeKar,
                      'nd'=>$namaDos,
                      'nk'=>$namaKar,
          
                      'd'=>array()
                  );
              }
              $mks=$jadwal->getJadwalRuangMks();
              foreach ($mks as $mk) {
                  $kodeMk=$mk->getKodeKelas();
                  $kp=$mk->getKp();
                  $isiMk=$mk->getKapasitas();
                  $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['d'][$kodeMk.'_'.$kp]=$isiMk;
                  $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['c']= 
                          $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['c'] + 1;
                  $jadwalUjians[$kodeHari]['d'][$jam]['c'] = $jadwalUjians[$kodeHari]['d'][$jam]['c'] + 1;
                  $jadwalUjians[$kodeHari]['c']=$jadwalUjians[$kodeHari]['c']+1;
              }
          } 
          
//          $kodeHaris=array(11,12,13,14,15,21,22,23,24,25);
//          foreach ($kodeHaris as $kodeHari) {
//              $minggu = substr($kodeHari,0,1);
//              $hari   = substr($kodeHari,1,1);
//              
//          }
          $c=new Criteria();
          $c->addAscendingOrderByColumn(PiketUjianPeer::MINGGU);
          $c->addAscendingOrderByColumn(PiketUjianPeer::HARI);
          $pikets = PiketUjianPeer::doSelectJoinDosen($c);
          foreach($pikets as $piket) {
              $minggu=$piket->getMinggu();
              $hari=$piket->getHari();
              $kodeDos=$piket->getKodeDosen();
              $jadwalUjians[$minggu.$hari]['p']=
                      $piket->getDosen()->getNama()." ($kodeDos)";
          }
          
          $data = sfYaml::dump($jadwalUjians);
          file_put_contents($filename, $data);
      }
      $this->jadwalUjians=$jadwalUjians;
      $data=sfYaml::dump($jadwalUjians);
      file_put_contents($filename, $data);
        
      $this->setLayout(false);
  }
  
  public function executeCetakLaporan(sfWebRequest $request) {
      $cetak = $request->getParameter('cetak');
      switch ($cetak) {
          case 'berita_acara':
          case 'jadwal_mhs':
              return $this->forward('penjadwalan_ujian','cetakJadwalUjian');
          case 'jadwal_jaga_dosen':
              return $this->forward('penjadwalan_ujian','cetakJadwalJagaDosen');
          case 'jadwal_jaga_karyawan':
              return $this->forward('penjadwalan_ujian','cetakJadwalJagaKaryawan');
          case 'serah_soal':
              return $this->forward('penjadwalan_ujian','cetakFormSerahSoal');
          
          case 'jadwal_pengawas':
              return $this->forward('penjadwalan_ujian','cetakJadwalUjianUntukPengawas');
          case 'berita_acara':
              return $this->forward('penjadwalan_ujian','cetakBeritaAcaraUjian');
          default:    
              return $this->forward('penjadwalan_ujian','cetakJadwalUjianPengawas');
      }
  }
  public function executeCetakFormSerahSoal(sfWebRequest $request) {
      $this->penjadwalan=new PenjadwalanUjian();
      $this->setLayout(false);
  
  }
  public function executeCetakPengantarBerkasUjian(sfWebRequest $request) {
//        $kodeMk=$request->getParameter('kodeMk','ALL');
//      
//      
//      
//        $c=new Criteria();
//        if ($kodeMk != 'ALL') {
//            $c->add(MataKuliahPeer::KODE_MK,$kodeMk);
//        }
//        $c->add(KelasMKPeer::STATUS_BUKA,1);
//        $c->addJoin(KelasMKPeer::KODE_MK, MataKuliahPeer::KODE_MK);
//        $c->addJoin(JadwalUjianPeer::KODE_MK, MataKuliahPeer::KODE_MK);
//        $c->clearSelectColumns()->clearGroupByColumns();
//        $c->addSelectColumn(MataKuliahPeer::KODE_MK);
//        $c->addSelectColumn(MataKuliahPeer::NAMA);
//        $c->addSelectColumn(JadwalUjianPeer::MINGGU);
//        $c->addSelectColumn(JadwalUjianPeer::HARI);
//        $c->addAscendingOrderByColumn(MataKuliahPeer::KODE_MK);
//        $c->setDistinct();
//        $rs=  MataKuliahPeer::doSelectStmt($c);
//        $this->mataKuliahReffs=array();
//        while ( $row=$rs->fetch(PDO::FETCH_NUM) ) {
//            $kodeMk=$row[0];
//            $nama=$row[1];
//            $this->mataKuliahReffs[$kodeMk]=array(
//                'n'=>$nama,
//                'm'=>$row[2],
//                'h'=>$row[3]
//            );
//        }          
        
      $this->penjadwalan=new PenjadwalanUjian();
      $this->jadwalUjians=$this->penjadwalan->generateReportJadwalUjian();
      
      $this->setLayout(false);
  }
  
  public function executeCetakJadwalPengawas(sfWebRequest $request){
      $format='JadwalPengawas';
      $surat=$this->getRequestParameter('surat',array('tanggal'=>'2013-10-21'));
      $tglAwal=$surat['tanggal'];
      $jenis=$this->getRequestParameter('jenis','UTS');
              
      $this->rows=  PenjadwalanUjian::generateReportUjianKeSiska($jenis, $tglAwal, $format);
      
  }
  
  public function executeSetRuangTugas(sfWebRequest $request) {

        $c=new Criteria();
        $c->add( JadwalUjianPeer::JENIS_UJIAN,'TGS' );
        $c->addAscendingOrderByColumn(JadwalUjianPeer::KODE_MK);
        $jadwals = JadwalUjianPeer::doSelect($c);
        foreach($jadwals as $jadwal) {
            $kodeMk = $jadwal->getKodemk();
          
                    
            $kodeDosen = null; //UNTUK jenis tugas ini defaultnya dikosongi saja
            //alasannya, belum tentu dijaga dosen kalau hanya mengumpulkan tugas
            //tidak mengurangi jatah maksimum 5 jaga ujian di kelas yang normal
            $kodeRuang = $jadwal->getPrioritasRuang();
            if (!$kodeRuang) {
                $kodeJur = substr($kodeMk,0,2);
                switch ( $kodeJur ) {
                    case '65':
                        $kodeRuang = 'TG 01.03';
                        break;
                    case '66':
                        $kodeRuang = 'PE 02.02';
                        break;
                    case '61':
                        $kodeRuang = 'TC 03';
                        break;
                    default:
                        $kodeRuang = 'TC 02.01';
                }
            }      
      
                $ruang = RuangPeer::retrieveByPK($kodeRuang);
                if (!$ruang) {
                    $ruang=new Ruang();
                    $ruang->setKodeRuang($kodeRuang);
                    $ruang->setJenis('LAB');
                    $ruang->setUntukUjian(0);
                    $ruang->setKapasitas(24);
                    $ruang->setKapasitasUjian(24);
                    $ruang->save();
                }
                
                $jr = new JadwalRuang();
                $jr->setKodeDosen($kodeDosen);
                $jr->setHari($jadwal->getHari());
                $jr->setMinggu($jadwal->getMinggu());
                $jr->setJam( $jadwal->getJam() );
                $jr->setKodeRuang($kodeRuang);
                $jr->save();
                $jrm=new JadwalRuangMk();
                $jrm->setJadwalRuangId($jr->getId());
                $jrm->setKodeKelas($kodeMk);
                $jrm->setKp('*');

                $jrm->save();      
            
        }
          
        return  $this->renderText("Done");
  }

  
    public function executeCetakBeritaAcaraUjian(sfWebRequest $request) {
      $filename=dirname(__FILE__).'/../../../../../cache/jadwalUjians.yml';
      $jadwalUjians = sfYaml::load($filename);
      
      
    }

}
