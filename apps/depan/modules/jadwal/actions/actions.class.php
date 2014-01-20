<?php

/**
 * jadwal actions.
 *
 * @package    perwalianft
 * @subpackage jadwal
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jadwalActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $jurusan_id=$this->getRequestParameter('jurusan_id','62-62');
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
    $c=new Criteria();
    $kelas_keys=array_keys($kelasMks);
    if ($jurusan_id != 'ALL') $c->add(JadwalKuliahPeer::KODE_KELAS,$kelas_keys,Criteria::IN);
    $c->addAscendingOrderByColumn(JadwalKuliahPeer::HARI);
    $c->addAscendingOrderByColumn(JadwalKuliahPeer::JAM_MASUK);
    $c->addAscendingOrderByColumn(JadwalKuliahPeer::JAM_KELUAR);
    $jadwalKuliahs=JadwalKuliahPeer::doSelect($c);

    $this->kelasMks=$kelasMks;
    $this->jadwalKuliahs=$jadwalKuliahs;
    $this->jurusan=$jurusan;

    $commit=$request->getParameter('commit');
    if ($commit=='Bikin Jadwal Tanpa Nama Dosen') {
        $this->setTemplate('jadwalTanpaNama');
    }
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

}
