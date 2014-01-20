<?php

/**
 * pendaftar actions.
 *
 * @package    perwalianft
 * @subpackage pendaftar
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pendaftarActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    
    $kode_jur=$this->getRequestParameter('kode_jur');
    $xls=$this->getRequestParameter('xls',0);
    $fpp=$this->getRequestParameter('fpp','ALL');
    $kelas=$this->getRequestParameter('kelas','');
    if ($xls) {
      $this->setLayout('xls');
      $this->getResponse()->setContentType('application/vnd.ms-excel');
      list($usec, $sec) = explode(" ", microtime());
      $kode=$this->getRequestParameter('kode',$sec.'_'.$usec);
      $this->getResponse()->setContentType('application/vnd.ms-excel');
      $this->getResponse()->setHttpHeader('Content-Disposition','attachment; filename=peserta_'.$kode.'.xls');
    }
    $status=$this->getRequestParameter('status',1);
    $kodeMKAktif=null;
    if ($kelas) {
      $kelasMk=KelasMKPeer::retrieveByPk($kelas);
      $kodeMKAktif=$kelasMk->getKodeMk();
    }
    
    $kelasMks=array();
    $matkuls=MataKuliahPeer::getMatkulJurusan($kode_jur, $kelasMks);
    $kodeKelass=array_keys($kelasMks);
    $daftars=array();
    if ($kodeMKAktif) {
      $daftars[$kodeMKAktif]=array();
      $daftars[$kodeMKAktif][$kelas]=array();
    } else {
      foreach ($kodeKelass as $kodeKelas) {
        $kelasMk=$kelasMks[$kodeKelas]; 
        if ( !array_key_exists($kelasMk->getKodeMK(), $daftars  ) ) $daftars[$kelasMk->getKodeMK()]=array();
        if ( !array_key_exists($kodeKelas, $daftars[$kelasMk->getKodeMK()] ) ) $daftars[$kelasMk->getKodeMK()][$kodeKelas]=array();
      }
    }

    $c=new Criteria();
    $c->addAscendingOrderByColumn(DaftarKelasPeer::KODE_KELAS);
    $c->addAscendingOrderByColumn(DaftarKelasPeer::NRP);
    if ($kelas) $c->add(DaftarKelasPeer::KODE_KELAS,$kelas);
    $c->add(DaftarKelasPeer::STATUS,$status);
    if ($fpp!='ALL') $c->add(DaftarKelasPeer::KODE_FPP,$fpp);
    $dkls=DaftarKelasPeer::doSelect($c);
    unset($c);
    foreach ($dkls as $dkl) {
      $kodeKelas=$dkl->getKodeKelas();
      $nrp=$dkl->getNrp();
      if (array_key_exists($kodeKelas,$kelasMks)) {
        $kelasMk=$kelasMks[$kodeKelas];
        $daftars[$kelasMk->getKodeMK()][$kodeKelas][$nrp]=$dkl;
      }
    }

    $c=new Criteria();
    $c->addAscendingOrderByColumn(SettingNrpPeer::KODE_KELAS);
    $c->addAscendingOrderByColumn(SettingNrpPeer::NRP_AWAL);
    $c->add(SettingNrpPeer::KODE_KELAS, array_keys($kelasMks), Criteria::IN);
    $settingNrpList=SettingNrpPeer::doSelect($c);
    $settingNrps=array();
    foreach ($settingNrpList as $settingNrp) {
      $kodeKelas=$settingNrp->getKodeKelas();
      if ( !array_key_exists($kodeKelas,$settingNrps) ) $settingNrps[$kodeKelas]=array();
      $settingNrps[$kodeKelas][]=$settingNrp->getNrpAwal().'-'.$settingNrp->getNrpAkhir();
    }
    $this->settingNrps=$settingNrps;
    $this->daftars=$daftars;
    $this->matkuls=$matkuls;
    $this->kelasMks=$kelasMks;
    $this->kodeMks=array_keys($matkuls);
  }
}
