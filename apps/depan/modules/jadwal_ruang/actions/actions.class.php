<?php

/**
 * jadwal_ruang actions.
 *
 * @package    perwalianft
 * @subpackage jadwal_ruang
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jadwal_ruangActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

    $semester=$this->getRequestParameter('semester');
 
    $penjadwalan=new Penjadwalan();
$errors=array();
    $infos=array();
    $penjadwalan->load($semester,$errors,$infos);
    $this->penjadwalan=$penjadwalan;
    $this->semester=$semester;


    $c=new Criteria();
    $c->addAscendingOrderByColumn(MataKuliahPeer::KODE_MK);
    $rows=MataKuliahPeer::doSelect($c);
    $matkuls=array();
    foreach($rows as $row)
    {
        $matkuls[$row->getKodeMk()]=$row->getNama();
    }
    $this->matkuls=$matkuls;


  }

  public function executeGenerate(sfWebRequest $request)
  {
    $penjadwalan=new Penjadwalan();
    $penjadwalan->isDebug=FALSE;
    $penjadwalan->inisialisasiPilihRuang();
    $penjadwalan->inisialisasiPilihDosen();
    $errors=array();
    $infos=array();
    $penjadwalan->pilihRuanganKelas($errors, $infos);
    $penjadwalan->pilihRuanganNonKelas($errors, $infos);
    $penjadwalan->pilihDosenKaryawan($errors, $infos);
    $penjadwalan->simpanPilihanRuang();
    $this->errors=$errors;
    $this->infos=$infos;
    $this->penjadwalan=$penjadwalan;

  }

  public function executeGenerateRuang(sfWebRequest $request)
  {
    $penjadwalan=new Penjadwalan();
    $penjadwalan->isDebug=FALSE;
    $penjadwalan->inisialisasiPilihRuang();
    $penjadwalan->inisialisasiPilihDosen();
    $errors=array();
    $infos=array();
    $penjadwalan->pilihRuanganKelas($errors, $infos);
    $penjadwalan->pilihRuanganNonKelas($errors, $infos);
    $penjadwalan->simpanPilihanRuang();
    $this->errors=$errors;
    $this->infos=$infos;
    $this->penjadwalan=$penjadwalan;


  }
  public function executeGeneratePetugas(sfWebRequest $request)
  {
    $penjadwalan=new Penjadwalan();
    $penjadwalan->isDebug=FALSE;
    $errors=array();
    $infos=array();
     
    $penjadwalan->load($errors, $infos, null);
    $penjadwalan->pilihDosenKaryawan($errors, $infos);
    $penjadwalan->simpanPilihanDosen();
    $this->errors=$errors;
    $this->infos=$infos;
    $this->penjadwalan=$penjadwalan;


  }

  public function executeUpdate(sfWebRequest $request)
  {
        $mcode=$this->getRequestParameter('mcode');
        $rcode=$this->getRequestParameter('rcode');
        $c=new Criteria();
        $c->add(JadwalRuangPeer::KODE_RUANG,$rcode);
        $c->add(JadwalRuangMkPeer::KODE_KELAS,$mcode);
        $c->addJoin(JadwalRuangMkPeer::JADWAL_RUANG_ID,JadwalRuangPeer::ID);
        $jr=JadwalRuangPeer::doSelectOne($c);
        if ($jr)
        {
            return $this->redirect('schedule_jadwal_ruang/edit?id='.$jr->getId());
        } else {
            return $this->redirect('jadwal_ruang/index');
        }
      
  }
}
