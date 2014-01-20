<?php

/**
 * Subclass for performing query and update operations on the 'tk_master_mk' table.
 *
 * 
 *
 * @package lib.model.perwalian_ft
 */ 
class MataKuliahPeer extends BaseMataKuliahPeer
{
  public static function getMatkulJurusan($kode_jur, &$kelasMks) {
    if (!$kode_jur) $kode_jur='ALL';
    $nonTeknik=array('ALL','MIPA','MKU');
    if ($kode_jur!='ALL') {
      $c=new Criteria();
      $c->addAscendingOrderByColumn(KelasJurusanPeer::KODE_KELAS);
      if ( in_array($kode_jur,$nonTeknik) ) {
        switch ($kode_jur) {
          case 'MIPA' :
            $c->add(KelasJurusanPeer::KODE_KELAS,'60%',Criteria::LIKE);
            break;
          case 'MKU' :
            $c->add(KelasJurusanPeer::KODE_KELAS,'0%',Criteria::LIKE);
            break;
        }
      } else {
        $c->add(KelasJurusanPeer::KODE_JUR,$kode_jur);       
      }
      $kelasJurusans=KelasJurusanPeer::doSelect($c);
      unset($c);
      $kodeKelass=array();
      foreach ($kelasJurusans as $kelasJurusan) {
        $kodeKelas=$kelasJurusan->getKodeKelas();
        $kodeKelass[]=$kodeKelas;
      }
    }  
    $c=new Criteria();
    $c->addAscendingOrderByColumn(KelasMKPeer::KODE_KELAS);
    if ($kode_jur!='ALL') $c->add(KelasMKPeer::KODE_KELAS,$kodeKelass,Criteria::IN);
    $kelasMkList=KelasMKPeer::doSelect($c);
    unset($c);
    $matkuls=array();
    $kodeMks=array();
    $kelasMks=array();
    foreach ($kelasMkList as $kelasMk) {
      $kodeKelas=$kelasMk->getKodeKelas();
      $kodeMk=$kelasMk->getKodeMk();
      if ( !in_array($kodeMk,$kodeMks) ) $kodeMks[]=$kodeMk;
      $kelasMks[$kodeKelas]=$kelasMk;
    }
    $c=new Criteria();
    $c->addAscendingOrderByColumn(MataKuliahPeer::KODE_MK);
    $c->add(MataKuliahPeer::KODE_MK,$kodeMks,Criteria::IN);
    $matakuliahs=MataKuliahPeer::doSelect($c);
    unset($c);
    foreach ($matakuliahs as $matakuliah){
      $matkuls[$matakuliah->getKodeMk()]=$matakuliah;
    }
    return $matkuls;
  }
}
