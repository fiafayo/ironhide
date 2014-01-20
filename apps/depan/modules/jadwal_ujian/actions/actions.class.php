<?php

/**
 * jadwal_ujian actions.
 *
 * @package    perwalianft
 * @subpackage jadwal_ujian
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class jadwal_ujianActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $jurusan_id=$this->getRequestParameter('jurusan_id', 'ALL');
    $nonTeknik=array('ALL','MKU','MIPA');
    if ( !in_array($jurusan_id,$nonTeknik) ) {
      $jurusan=JurusanPeer::retrieveByPk($jurusan_id);
      if (!$jurusan) {
        $jurusan=JurusanPeer::retrieveByPk('62-62');
      }
      if (!$jurusan) {
        $this->getRequest()->setError('jurusan_id','Kode jurusan tidak valid!');
        return $this->redirect('jadwal/index');
      }
      $kelasJurusans=$jurusan->getKelasJurusans();
    } else {
      $jurusan=null;
      switch ($jurusan_id) {
        case 'ALL' :
          $kelasJurusans=KelasJurusanPeer::doSelect( new Criteria() );
          break;
        case 'MKU' :
          $c=new Criteria();
          $c->addJoin(KelasJurusanPeer::KODE_KELAS, KelasMKPeer::KODE_KELAS );
          $c->add(KelasMKPeer::KODE_MK,'0%',Criteria::LIKE);
          $kelasJurusans=KelasJurusanPeer::doSelect( $c );
          break;
        case 'MIPA':
          $c=new Criteria();
          $c->addJoin(KelasJurusanPeer::KODE_KELAS, KelasMKPeer::KODE_KELAS );
          $c->add(KelasMKPeer::KODE_MK,'60%',Criteria::LIKE);
          $kelasJurusans=KelasJurusanPeer::doSelect( $c );
          break;
      }
    }
    $kelasMks=array();
    foreach($kelasJurusans as $kelasJurusan) {
      $kodeKelas=$kelasJurusan->getKodeKelas();
      if ( !array_key_exists($kodeKelas, $kelasMks) ) {
        $kelasMks[$kodeKelas]=KelasMKPeer::retrieveByPk($kodeKelas);
        ksort($kelasMks);
      }
    }
    $kodeMks=array();
    foreach ($kelasMks as $kelasMk) {
      if ($kelasMk) {
        $kodeMk=$kelasMk->getKodeMk();
        $kapasitas=$kelasMk->getKapasitas();
        if ( !array_key_exists($kodeMk, $kodeMks) ) {
          $kodeMks[$kodeMk]=$kapasitas;
          ksort($kodeMks);
        } else {

          $kapasitasOld=$kodeMks[$kodeMk];
          $kodeMks[$kodeMk]=$kapasitas+$kapasitasOld;
        }
      }
    }
    $c=new Criteria();
    $kodeMkKeys=array_keys($kodeMks);
    if ($jurusan_id != 'ALL') $c->add(JadwalUjianPeer::KODE_MK,$kodeMkKeys,Criteria::IN);
    $c->addAscendingOrderByColumn(JadwalUjianPeer::MINGGU);
    $c->addAscendingOrderByColumn(JadwalUjianPeer::HARI);
    $c->addAscendingOrderByColumn(JadwalUjianPeer::JAM);
    $jadwalUjians=JadwalUjianPeer::doSelect($c);

    $this->kelasMks=$kelasMks;
    $this->kodeMks=$kodeMks;
    $this->jadwalUjians=$jadwalUjians;
    $this->jurusan=$jurusan;
    $xls=$this->getRequestParameter('xls');
    if ($xls) {
      $this->setLayout('xls');
      $this->getResponse()->setContentType('application/vnd.ms-excel');

      list($usec, $sec) = explode(" ", microtime());
      $kode=$this->getRequestParameter('kode',$sec.'_'.$usec);
      $this->getResponse()->setContentType('application/vnd.ms-excel');
      $this->getResponse()->setHttpHeader('Content-Disposition','attachment; filename=jadwal_'.$kode.'.xls');
    }
    $this->xls=$xls;
  }

  
  
  public function executeJadwal(sfWebRequest $request)
  {
    $penjadwalan=new Penjadwalan();
    $penjadwalan->isDebug=FALSE;
    $errors=array();
    $infos=array();
    //$penjadwalan->inisialisasiPilihRuang();
    $penjadwalan->load($errors, $infos);
    $this->penjadwalan=$penjadwalan;    
  }

  public function executeJadwalRinci(sfWebRequest $request)
  {
        $xls=$this->getRequestParameter('xls',0);
        if ($xls)
        {
            $this->setLayout('xls');
            list($usec, $sec) = explode(" ", microtime());
            $kode=$sec.'_'.$usec;
            $this->getResponse()->setContentType('application/vnd.ms-excel');
            $this->getResponse()->setHttpHeader('Content-Disposition','attachment; filename='.$kode.'.xls');
        }
        $semester=$this->getRequestParameter('semester');
        if (!$semester)
        {
                $thsms=TahunSemesterPeer::getDefault();
                $kodePerwalian=TahunSemesterPeer::getDefaultKodePerwalian();
        } else {
            $c=new Criteria();
            $c->add(TahunSemesterPeer::SEMESTER,$semester);
            $thsms=TahunSemesterPeer::doSelectOne($c);
            unset($c);
            $kodePerwalian=$thsms->getKodePerwalian();
        }
        $this->thsms=$thsms;
        $this->kodePerwalian=$kodePerwalian;
        $semester=$this->thsms->getKode();

        $c=new Criteria();
        $c->add(JadwalRuangPeer::SEMESTER,$this->thsms->getKode());
        $c->addAscendingOrderByColumn(JadwalRuangPeer::MINGGU);
        $c->addAscendingOrderByColumn(JadwalRuangPeer::HARI);
        $c->addAscendingOrderByColumn(JadwalRuangPeer::JAM);
        $c->addAscendingOrderByColumn(JadwalRuangPeer::KODE_RUANG);
        $jrs=JadwalRuangPeer::doSelect($c);  //jadwal ruang per jam ujian
        unset($c);

        
        $c=new Criteria();
        $c->add(JadwalRuangMkPeer::JADWAL_RUANG_ID, JadwalRuangMkPeer::JADWAL_RUANG_ID." IN (SELECT id FROM jadwal_ruang WHERE semester='$semester')", Criteria::CUSTOM );
        $c->addAscendingOrderByColumn(JadwalRuangMkPeer::JADWAL_RUANG_ID);
        $jrms=JadwalRuangMkPeer::doSelect($c); //jadwal ruang dan matakuliah + kp
        unset($c);

        $c=new Criteria();
        $c->addAscendingOrderByColumn(MataKuliahPeer::KODE_MK);
        $c->add(MataKuliahPeer::KODE_MK,MataKuliahPeer::KODE_MK." IN ( SELECT DISTINCT kmk.kode_mk FROM tk_kelas_mk kmk WHERE kmk.kode_kelas like '%$kodePerwalian' AND kmk.status_buka=1 ORDER BY kmk.kode_mk) ",Criteria::CUSTOM);
        $mks=MataKuliahPeer::doSelect($c); //ngambil master maka kuliah
        unset($c);


        $c=new Criteria();
        $c->add(KelasMKPeer::KODE_KELAS,'%'.$kodePerwalian, Criteria::LIKE);
        $c->add(KelasMKPeer::STATUS_BUKA,1);
        $c->addAscendingOrderByColumn(KelasMKPeer::KODE_KELAS);
        $kelasMks=KelasMKPeer::doSelect($c);
        unset($c);

        $isiKelas=array();
        foreach ($kelasMks as $kelasMk)
        {
            $isiKelas[$kelasMk->getKodeMk().$kelasMk->getKp()]=$kelasMk->getIsi();
        }

        $arRuang=array();
        $arRuangMk=array();
        $arMk=array();
        $id2Hari=array();

//        $haris=array(11,12,13,14,15,21,22,23,24,25);
//        foreach ($haris as $hari)  //inisialisasi
//        {
//            $arRuang[$hari]=array();
//            for ($jam=1; $jam<=4; $jam++)
//            {
//                $arRuang[$hari][$jam]=array(
//                );
//            }
//        }

        foreach( $mks as $mk )
        {
            $arMk[$mk->getKodeMk()]=$mk->getNama();
        }

        foreach ($jrms as $jrm)
        {
            $mk=$jrm->getKodeKelas();
            $kp=$jrm->getKp();
            $isi=$jrm->getKapasitas();
            $id=$jrm->getJadwalRuangId();
            if ( !isset( $arRuangMk[$id] )  )  $arRuangMk[$id]=array();
            $arRuangMk[$id][$mk.$kp.$id]=array('mk'=>$mk, 'isi'=>$isi, 'kp'=>$kp, 'rid'=>$id);
            
        }
        
        foreach ($jrs as $jr)
        {
            $hari=$jr->getHari();
            $minggu=$jr->getMinggu();
            $jam=$jr->getJam();
            $ruang=$jr->getKodeRuang();
            $id=$jr->getId();
            $dos=$jr->getKodeDosen();
            $kar=$jr->getKodeKaryawan();
            $kodeHari=$minggu*100+$hari*10+$jam;
            
            if ( !isset( $arRuang[$kodeHari])  )  $arRuang[$kodeHari]=array();
            
            if ( isset( $arRuangMk[$id] ) )
            {
                //ksort($arRuangMk[$id]); //harus disortir
                foreach ( $arRuangMk[$id] as $key=>$data )
                {
                    $arRuang[$kodeHari][ $key ]=$data;
                    $arRuang[$kodeHari][ $key ]['rua']=$ruang;
                    $arRuang[$kodeHari][ $key ]['dos']=$dos;
                    $arRuang[$kodeHari][ $key ]['kar']=$kar;
                    $arRuang[$kodeHari][ $key ]['rid']=$id;
                    if ( isset( $arMk[ $data['mk'] ]  ) )  $arRuang[$kodeHari][ $key ]['nmk']=$arMk[ $data['mk'] ];
                    if ( isset( $isiKelas[ $data['mk'].$data['kp'] ]  ) )  $arRuang[$kodeHari][ $key ]['kap']=$isiKelas[ $data['mk'].$data['kp'] ];                   
                }
            }


 
        }
        //ksort($arRuang);
        $this->arRuang=$arRuang;
        $this->arRuangMk=$arRuangMk;

        $c=new Criteria();
        $c->add(DosenPeer::IS_PENGAWAS,1);
        $c->addAscendingOrderByColumn(DosenPeer::KODE_DOSEN);
        $dosens=DosenPeer::doSelect($c);
        unset($c);
        $dosenNames=array();
        foreach ($dosens as $dosen)
        {
            $dosenNames[$dosen->getKodeDosen()]=$dosen->getNama();
        }
        $this->dosenNames=$dosenNames;
         
        $c=new Criteria();
        $c->add(KaryawanPeer::IS_PENGAWAS,1);
        $c->addAscendingOrderByColumn(KaryawanPeer::KODE_KARYAWAN);
        $karyawans=KaryawanPeer::doSelect($c);
        unset($c);
        $karyawanNames=array();
        foreach ($karyawans as $karyawan)
        {
            $karyawanNames[$karyawan->getKodeKaryawan()]=$karyawan->getNama();
        }
        $this->karyawanNames=$karyawanNames;


  }


  public function executeUpdateRuang(sfWebRequest $request)
  {
      $id=$request->getParameter('id');
      $jadwal=JadwalRuangPeer::retrieveByPK($id);
      $this->forward404Unless($jadwal);
      $mk=$request->getParameter('mk');
      $kp=$request->getParameter('kp');
      $c=new Criteria();
      $c->add(JadwalRuangMkPeer::KODE_KELAS,$mk);
      $c->add(JadwalRuangMkPeer::KP,$kp);
      $c->add(JadwalRuangMkPeer::JADWAL_RUANG_ID,$id);
      $jadwalMk=JadwalRuangMkPeer::doSelectOne($c);
      unset($c);
      $this->forward404Unless($jadwalMk);
      $this->jadwal=$jadwal;
      $this->jadwalMk=$jadwalMk;

      $c=new Criteria();
      $c->add( RuangPeer::UNTUK_UJIAN,1 );
      $c->addAscendingOrderByColumn(RuangPeer::KODE_RUANG);
      $ruangs=RuangPeer::doSelect($c);
      unset($c);
      $ruangUjians=array();
      $hari=$jadwal->getHari();
      $minggu=$jadwal->getMinggu();
      $jam=$jadwal->getJam();
      //$kdruang=$jadwal->getKodeRuang();
      $con=Propel::getConnection(RuangPeer::DATABASE_NAME);
      foreach ($ruangs as $ruang)
      {
          $isi=0;
          $kdruang=$ruang->getKodeRuang();
          $sql="SELECT sum(kapasitas) as jml FROM `jadwal_ruang_mk` WHERE jadwal_ruang_id IN ( SELECT id from jadwal_ruang  WHERE minggu=? and hari=? and jam=? and kode_ruang=?)";
          $stmt=$con->prepare($sql);
          $stmt->bindValue(1,$minggu);
          $stmt->bindValue(2,$hari);
          $stmt->bindValue(3,$jam);
          $stmt->bindValue(4,$kdruang);
          $stmt->execute();
          $row=$stmt->fetch();
          if ($row)
          {
              $isi=$row['jml'] ;
          }
          $isi=intval($isi);
          $ruangUjians[$ruang->getKodeRuang()]=$ruang->getJenis().', terisi '.$isi.'/'.$ruang->getKapasitasUjian();
      }
      $this->ruangUjians=$ruangUjians;

      if ($request->getMethod()==sfRequest::POST)
      {
          $con=Propel::getConnection(RuangPeer::DATABASE_NAME);
          try {
              $con->beginTransaction();
              $kodeRuang=$request->getParameter('kode_ruang');
              $c=new Criteria();
              $c->add(JadwalRuangPeer::MINGGU, $jadwal->getMinggu());
              $c->add(JadwalRuangPeer::HARI, $jadwal->getHari());
              $c->add(JadwalRuangPeer::JAM, $jadwal->getJam());
              $c->add(JadwalRuangPeer::KODE_RUANG, $kodeRuang);
              $jadwalBaru=JadwalRuangPeer::doSelectOne($c,$con);
              if (!$jadwalBaru)
              {
                  $jadwalBaru=new JadwalRuang();
                  $jadwalBaru->setMinggu($jadwal->getMinggu());
                  $jadwalBaru->setHari($jadwal->getHari());
                  $jadwalBaru->setJam($jadwal->getJam());
                  $jadwalBaru->setKodeRuang($kodeRuang);
                  $jadwalBaru->setSemester( $jadwal->getSemester() );
                  $jadwalBaru->setKodeDosen(0);
                  $jadwalBaru->setKodeKaryawan(0);
                  $jadwalBaru->save($con);
              }
              $jadwalMk->setJadwalRuangId($jadwalBaru->getId());
              $jadwalMk->save($con);
              $con->commit();
              return $this->redirect('jadwal_ujian/jadwalRinci');

          } catch (Exception $e) {
              $con->rollBack();
              sfContext::getInstance()->getLogger()->err('{Heloz} Gagal menyimpan perubahan karena '.$e->getMessage());
              $this->setError('db','Gagal menyimpan perubahan karena '.$e->getMessage());
              return sfView::SUCCESS;
          }
      }

  }

  public function executeUpdateDosen(sfWebRequest $request)
  {
      $id=$request->getParameter('id');
      $jadwal=JadwalRuangPeer::retrieveByPK($id);
      $this->forward404Unless($jadwal);
      $dos=$request->getParameter('dos');
      $dosen=DosenPeer::retrieveByPk($dos);
      //$this->forward404Unless($dosen);
      $this->jadwal=$jadwal;
      $this->dosen=$dosen;


      $ruang=RuangPeer::retrieveByPk($jadwal->getKodeRuang());
      $this->ruang=$ruang;

      $hari=$jadwal->getHari();
      $minggu=$jadwal->getMinggu();
      $jam=$jadwal->getJam();
      $kdruang=$jadwal->getKodeRuang();

      $con=Propel::getConnection(RuangPeer::DATABASE_NAME);


          $isi=0;
          $sql="SELECT sum(kapasitas) as jml FROM `jadwal_ruang_mk` WHERE jadwal_ruang_id = ? ";
          $stmt=$con->prepare($sql);
          $stmt->bindValue(1,$jadwal->getId());
          $stmt->execute();
          $row=$stmt->fetch();
          if ($row)
          {
              $isi=$row['jml'] ;
          }
          $this->isi=intval($isi);

          $c=new Criteria();
          $c->addAscendingOrderByColumn(DosenPeer::KODE_DOSEN);
          $csql='';
          if ( $dosen  )  $csql=DosenPeer::KODE_DOSEN."='$dos' OR ";
          $c->add(DosenPeer::NAMA, $csql.DosenPeer::KODE_DOSEN." NOT IN ( SELECT kode_dosen FROM jadwal_ruang WHERE minggu=$minggu AND hari=$hari AND jam=$jam )", Criteria::CUSTOM );
          //$c->addAscendingOrderByColumn(DosenPeer::NAMA);
          $c->add(DosenPeer::IS_PENGAWAS,1);
          $this->dosens=DosenPeer::doSelect($c);
          unset($c);
          $dosenNames=array();
          foreach (  $this->dosens as $dsn )
          {
            $dosenNames[$dsn->getKodeDosen()]=$dsn->getNama();
          }
          $this->dosenNames=$dosenNames;
          



      if ($request->getMethod()==sfRequest::POST)
      {
        $jadwal->setKodeDosen($dos);
        $jadwal->save();
        return $this->redirect('jadwal_ujian/jadwalRinci');
      }
      
      
  }


  public function executeUpdateKaryawan(sfWebRequest $request)
  {
      $id=$request->getParameter('id');
      $jadwal=JadwalRuangPeer::retrieveByPK($id);
      $this->forward404Unless($jadwal);
      $kar=$request->getParameter('kar');
      $karyawan=KaryawanPeer::retrieveByPk($kar);
      //$this->forward404Unless($karyawan);
      $this->jadwal=$jadwal;
      $this->karyawan=$karyawan;


      $ruang=RuangPeer::retrieveByPk($jadwal->getKodeRuang());
      $this->ruang=$ruang;

      $hari=$jadwal->getHari();
      $minggu=$jadwal->getMinggu();
      $jam=$jadwal->getJam();
      $kdruang=$jadwal->getKodeRuang();

      $con=Propel::getConnection(RuangPeer::DATABASE_NAME);


          $isi=0;
          $sql="SELECT sum(kapasitas) as jml FROM `jadwal_ruang_mk` WHERE jadwal_ruang_id = ? ";
          $stmt=$con->prepare($sql);
          $stmt->bindValue(1,$jadwal->getId());
          $stmt->execute();
          $row=$stmt->fetch();
          if ($row)
          {
              $isi=$row['jml'] ;
          }
          $this->isi=intval($isi);

          $c=new Criteria();
          $c->addAscendingOrderByColumn(KaryawanPeer::KODE_KARYAWAN);
          $csql='';
          if ( $karyawan  )  $csql=KaryawanPeer::KODE_KARYAWAN."='$kar' OR ";
          $c->add(KaryawanPeer::NAMA, $csql.KaryawanPeer::KODE_KARYAWAN." NOT IN ( SELECT kode_karyawan FROM jadwal_ruang WHERE minggu=$minggu AND hari=$hari AND jam=$jam )", Criteria::CUSTOM );
          //$c->addAscendingOrderByColumn(KaryawanPeer::NAMA);
          $c->add(KaryawanPeer::IS_PENGAWAS,1);
          $this->karyawans=KaryawanPeer::doSelect($c);
          unset($c);
          $karyawanNames=array();
          foreach (  $this->karyawans as $dsn )
          {
            $karyawanNames[$dsn->getKodeKaryawan()]=$dsn->getNama();
          }
          $this->karyawanNames=$karyawanNames;




      if ($request->getMethod()==sfRequest::POST)
      {
        $jadwal->setKodeKaryawan($kar);
        $jadwal->save();
        return $this->redirect('jadwal_ujian/jadwalRinci');
      }


  }

  public function executeUpdateIsi(sfWebRequest $request)
  {
      $id=$request->getParameter('id');
      $jadwal=JadwalRuangPeer::retrieveByPK($id);
      $this->forward404Unless($jadwal);
      $mk=$request->getParameter('mk');
      $kp=$request->getParameter('kp');
      $c=new Criteria();
      $c->add(JadwalRuangMkPeer::KODE_KELAS,$mk);
      $c->add(JadwalRuangMkPeer::KP,$kp);
      $c->add(JadwalRuangMkPeer::JADWAL_RUANG_ID,$id);
      $jadwalMk=JadwalRuangMkPeer::doSelectOne($c);
      unset($c);
      $this->forward404Unless($jadwalMk);
      $this->jadwal=$jadwal;
      $this->jadwalMk=$jadwalMk;


      if ($request->getMethod()==sfRequest::POST)
      {
          $con=Propel::getConnection(RuangPeer::DATABASE_NAME);
          try {
              $con->beginTransaction();
              $isi=$request->getParameter('isi',0);
              $jadwalMk->setKapasitas($isi);
              $jadwalMk->save($con);
              $con->commit();
              return $this->redirect('jadwal_ujian/jadwalRinci');

          } catch (Exception $e) {
              $con->rollBack();
              sfContext::getInstance()->getLogger()->err('{Heloz} Gagal menyimpan perubahan karena '.$e->getMessage());
              $this->setError('db','Gagal menyimpan perubahan karena '.$e->getMessage());
              return sfView::SUCCESS;
          }
      }

  }



  public function executeJadwalRinciDosen(sfWebRequest $request)
  {
        $xls=$this->getRequestParameter('xls',0);
        if ($xls)
        {
            $this->setLayout('xls');
            list($usec, $sec) = explode(" ", microtime());
            $kode=$sec.'_'.$usec;
            $this->getResponse()->setContentType('application/vnd.ms-excel');
            $this->getResponse()->setHttpHeader('Content-Disposition','attachment; filename='.$kode.'.xls');
        }

        $print=$this->getRequestParameter('print',0);
        if ($print)
        {
            $this->setLayout('printout');
        }
        $semester=$this->getRequestParameter('semester');
        if (!$semester)
        {
                $thsms=TahunSemesterPeer::getDefault();
                $kodePerwalian=TahunSemesterPeer::getDefaultKodePerwalian();
        } else {
            $c=new Criteria();
            $c->add(TahunSemesterPeer::SEMESTER,$semester);
            $thsms=TahunSemesterPeer::doSelectOne($c);
            unset($c);
            $kodePerwalian=$thsms->getKodePerwalian();
        }
        $this->thsms=$thsms;
        $this->kodePerwalian=$kodePerwalian;
        $semester=$this->thsms->getKode();

        $c=new Criteria();
        $c->add(JadwalRuangPeer::SEMESTER,$this->thsms->getKode());
        $c->addAscendingOrderByColumn(JadwalRuangPeer::KODE_DOSEN);
        $c->addAscendingOrderByColumn(JadwalRuangPeer::MINGGU);
        $c->addAscendingOrderByColumn(JadwalRuangPeer::HARI);
        $c->addAscendingOrderByColumn(JadwalRuangPeer::JAM);
        $jrs=JadwalRuangPeer::doSelect($c);  //jadwal ruang per jam ujian
        unset($c);


        $c=new Criteria();
        $c->add(JadwalRuangMkPeer::JADWAL_RUANG_ID, JadwalRuangMkPeer::JADWAL_RUANG_ID." IN (SELECT id FROM jadwal_ruang WHERE semester='$semester')", Criteria::CUSTOM );
        $c->addAscendingOrderByColumn(JadwalRuangMkPeer::JADWAL_RUANG_ID);
        $jrms=JadwalRuangMkPeer::doSelect($c); //jadwal ruang dan matakuliah + kp
        unset($c);

        $c=new Criteria();
        $c->addAscendingOrderByColumn(MataKuliahPeer::KODE_MK);
        $c->add(MataKuliahPeer::KODE_MK,MataKuliahPeer::KODE_MK." IN ( SELECT DISTINCT kmk.kode_mk FROM tk_kelas_mk kmk WHERE kmk.kode_kelas like '%$kodePerwalian' AND kmk.status_buka=1 ORDER BY kmk.kode_mk) ",Criteria::CUSTOM);
        $mks=MataKuliahPeer::doSelect($c); //ngambil master maka kuliah
        unset($c);




        $arRuang=array();
        $arRuangMk=array();
        $arDosen=array();
        $arMk=array();

        $id2Hari=array();

        foreach( $mks as $mk )
        {
            $arMk[$mk->getKodeMk()]=$mk->getNama();
        }

        foreach ($jrms as $jrm)
        {
            $mk=$jrm->getKodeKelas();
            $kp=$jrm->getKp();
            $isi=$jrm->getKapasitas();
            $id=$jrm->getJadwalRuangId();
            if ( !isset( $arRuangMk[$id] )  )  $arRuangMk[$id]=array();
            $arRuangMk[$id][$mk.$kp.$id]=array('mk'=>$mk, 'isi'=>$isi, 'kp'=>$kp, 'rid'=>$id);

        }

        foreach ($jrs as $jr)
        {
            $hari=$jr->getHari();
            $minggu=$jr->getMinggu();
            $jam=$jr->getJam();
            $ruang=$jr->getKodeRuang();
            $id=$jr->getId();
            $dos=$jr->getKodeDosen();
            $kar=$jr->getKodeKaryawan();
            $kodeHari=$minggu*100+$hari*10+$jam;

            if ( !isset( $arRuang[$dos])  )  $arRuang[$dos]=array();
            $arRuang[$dos][$id]=array(
                'rua'=>$jr,
                'mk'=>$arRuangMk[$id]
            );
        }
        //ksort($arRuang);
        $this->arRuang=$arRuang;
        $this->arRuangMk=$arRuangMk;
        $this->arMk=$arMk;

        $c=new Criteria();
        $c->add(DosenPeer::IS_PENGAWAS,1);
        $c->addAscendingOrderByColumn(DosenPeer::KODE_DOSEN);
        $dosens=DosenPeer::doSelect($c);
        unset($c);
        $dosenNames=array();
        foreach ($dosens as $dosen)
        {
            $dosenNames[$dosen->getKodeDosen()]=$dosen->getNama();
        }
        $this->dosenNames=$dosenNames;
//
//        $c=new Criteria();
//        $c->add(KaryawanPeer::IS_PENGAWAS,1);
//        $c->addAscendingOrderByColumn(KaryawanPeer::KODE_KARYAWAN);
//        $karyawans=KaryawanPeer::doSelect($c);
//        unset($c);
//        $karyawanNames=array();
//        foreach ($karyawans as $karyawan)
//        {
//            $karyawanNames[$karyawan->getKodeKaryawan()]=$karyawan->getNama();
//        }
//        $this->karyawanNames=$karyawanNames;


  }



  public function executeJadwalRinciKaryawan(sfWebRequest $request)
  {
        $xls=$this->getRequestParameter('xls',0);
        if ($xls)
        {
            $this->setLayout('xls');
            list($usec, $sec) = explode(" ", microtime());
            $kode=$sec.'_'.$usec;
            $this->getResponse()->setContentType('application/vnd.ms-excel');
            $this->getResponse()->setHttpHeader('Content-Disposition','attachment; filename='.$kode.'.xls');
        }
        $print=$this->getRequestParameter('print',0);
        if ($print)
        {
            $this->setLayout('printout');
        }
        $semester=$this->getRequestParameter('semester');
        if (!$semester)
        {
                $thsms=TahunSemesterPeer::getDefault();
                $kodePerwalian=TahunSemesterPeer::getDefaultKodePerwalian();
        } else {
            $c=new Criteria();
            $c->add(TahunSemesterPeer::SEMESTER,$semester);
            $thsms=TahunSemesterPeer::doSelectOne($c);
            unset($c);
            $kodePerwalian=$thsms->getKodePerwalian();
        }
        $this->thsms=$thsms;
        $this->kodePerwalian=$kodePerwalian;
        $semester=$this->thsms->getKode();

        $c=new Criteria();
        $c->add(JadwalRuangPeer::SEMESTER,$this->thsms->getKode());
        $c->addAscendingOrderByColumn(JadwalRuangPeer::KODE_KARYAWAN);
        $c->addAscendingOrderByColumn(JadwalRuangPeer::MINGGU);
        $c->addAscendingOrderByColumn(JadwalRuangPeer::HARI);
        $c->addAscendingOrderByColumn(JadwalRuangPeer::JAM);
        $jrs=JadwalRuangPeer::doSelect($c);  //jadwal ruang per jam ujian
        unset($c);


        $c=new Criteria();
        $c->add(JadwalRuangMkPeer::JADWAL_RUANG_ID, JadwalRuangMkPeer::JADWAL_RUANG_ID." IN (SELECT id FROM jadwal_ruang WHERE semester='$semester')", Criteria::CUSTOM );
        $c->addAscendingOrderByColumn(JadwalRuangMkPeer::JADWAL_RUANG_ID);
        $jrms=JadwalRuangMkPeer::doSelect($c); //jadwal ruang dan matakuliah + kp
        unset($c);

        $c=new Criteria();
        $c->addAscendingOrderByColumn(MataKuliahPeer::KODE_MK);
        $c->add(MataKuliahPeer::KODE_MK,MataKuliahPeer::KODE_MK." IN ( SELECT DISTINCT kmk.kode_mk FROM tk_kelas_mk kmk WHERE kmk.kode_kelas like '%$kodePerwalian' AND kmk.status_buka=1 ORDER BY kmk.kode_mk) ",Criteria::CUSTOM);
        $mks=MataKuliahPeer::doSelect($c); //ngambil master maka kuliah
        unset($c);




        $arRuang=array();
        $arRuangMk=array();
        $arDosen=array();
        $arMk=array();

        $id2Hari=array();

        foreach( $mks as $mk )
        {
            $arMk[$mk->getKodeMk()]=$mk->getNama();
        }

        foreach ($jrms as $jrm)
        {
            $mk=$jrm->getKodeKelas();
            $kp=$jrm->getKp();
            $isi=$jrm->getKapasitas();
            $id=$jrm->getJadwalRuangId();
            if ( !isset( $arRuangMk[$id] )  )  $arRuangMk[$id]=array();
            $arRuangMk[$id][$mk.$kp.$id]=array('mk'=>$mk, 'isi'=>$isi, 'kp'=>$kp, 'rid'=>$id);

        }

        foreach ($jrs as $jr)
        {
            $hari=$jr->getHari();
            $minggu=$jr->getMinggu();
            $jam=$jr->getJam();
            $ruang=$jr->getKodeRuang();
            $id=$jr->getId();
            $dos=$jr->getKodeDosen();
            $kar=$jr->getKodeKaryawan();
            $kodeHari=$minggu*100+$hari*10+$jam;

            if ( !isset( $arRuang[$kar])  )  $arRuang[$kar]=array();
            $arRuang[$kar][$id]=array(
                'rua'=>$jr,
                'mk'=>$arRuangMk[$id]
            );
        }
        //ksort($arRuang);
        $this->arRuang=$arRuang;
        $this->arRuangMk=$arRuangMk;
        $this->arMk=$arMk;
//
//        $c=new Criteria();
//        $c->add(DosenPeer::IS_PENGAWAS,1);
//        $c->addAscendingOrderByColumn(DosenPeer::KODE_DOSEN);
//        $dosens=DosenPeer::doSelect($c);
//        unset($c);
//        $dosenNames=array();
//        foreach ($dosens as $dosen)
//        {
//            $dosenNames[$dosen->getKodeDosen()]=$dosen->getNama();
//        }
//        $this->dosenNames=$dosenNames;
//
        $c=new Criteria();
        $c->add(KaryawanPeer::IS_PENGAWAS,1);
        $c->addAscendingOrderByColumn(KaryawanPeer::KODE_KARYAWAN);
        $karyawans=KaryawanPeer::doSelect($c);
        unset($c);
        $karyawanNames=array();
        foreach ($karyawans as $karyawan)
        {
            $karyawanNames[$karyawan->getKodeKaryawan()]=$karyawan->getNama();
        }
        $this->karyawanNames=$karyawanNames;


  }
  

}
