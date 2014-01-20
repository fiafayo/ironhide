<?php

/**
 * Subclass for performing query and update operations on the 'tk_minat_mk' table.
 *
 *
 *
 * @package lib.model.perwalian_ft
 */
class MinatMataKuliahPeer extends BaseMinatMataKuliahPeer
{
  public static function getPeminatPerJurusanPerAngkatan($kodeJur='64-64')
  {
    $c=new Criteria();
    $c->clearSelectColumns()->clearGroupByColumns();
    $c->addJoin(MinatMataKuliahPeer::KODE_MK,MataKuliahJurusanPeer::KODE_MK);
    $c->add(MataKuliahJurusanPeer::KODE_JUR,$kodeJur);
    $c->addSelectColumn(MinatMataKuliahPeer::KODE_MK);
    $c->addSelectColumn(MinatMataKuliahPeer::ANGKATAN);
    $c->addSelectColumn('COUNT('.MinatMataKuliahPeer::NRP.')');
    $c->addGroupByColumn(MinatMataKuliahPeer::KODE_MK);
    $c->addGroupByColumn(MinatMataKuliahPeer::ANGKATAN);
    $c->addAscendingOrderByColumn(MinatMataKuliahPeer::KODE_MK);
    $c->addAscendingOrderByColumn(MinatMataKuliahPeer::ANGKATAN);
    $rs = MinatMataKuliahPeer::doSelectRS($c);
    unset($c);
    $peminats=array();
    while ( $rs->next() ) {
      $kodeMk=$rs->getString(1);
      if ( !array_key_exists($kodeMk,$peminats) ) $peminats[$kodeMk]=array();
      $angkatan=$rs->getInt(2);
      $jml=$rs->getInt(3);
      $peminats[$kodeMk][$angkatan]=$jml;
    }
    return $peminats;
  }
}
