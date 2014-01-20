<?php


/**
 * Skeleton subclass for performing query and update operations on the 'tk_kelas_mk' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Wed Sep 29 15:18:04 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model.perwalian_ft
 */
class KelasMKPeer extends BaseKelasMKPeer {
    public static function doSelectThisSemester(Criteria $criteria, $con=null)
    {
        if ($criteria) $c=clone $criteria; else $c=new Criteria();
        $thsms=TahunSemesterPeer::getDefault();
        $c->add(KelasMKPeer::SEMESTER,$thsms->getSemester());
        $c->add(KelasMKPeer::TAHUN,$thsms->getTahun());
        $c->addAscendingOrderByColumn(self::KODE_KELAS);
        return self::doSelect($c, $con);
    }
    public static function doCountThisSemester(Criteria $criteria, $con=null)
    {
        if ($criteria) $c=clone $criteria; else $c=new Criteria();
        $thsms=TahunSemesterPeer::getDefault();
        $c->add(KelasMKPeer::SEMESTER,$thsms->getSemester());
        $c->add(KelasMKPeer::TAHUN,$thsms->getTahun());
        return self::doCount($c, $con);
    }

} // KelasMKPeer