<?php

/**
 * konversi actions.
 *
 * @package    perwalianft
 * @subpackage konversi
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class konversiActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $sf_user=$this->getUser();
      $c=new Criteria();
      $c->addAscendingOrderByColumn(KonversiMkPeer::TAHUN);
      $c->addAscendingOrderByColumn(KonversiMkPeer::KODE_JUR);
      $c->addAscendingOrderByColumn(KonversiMkPeer::JENIS_KONVERSI);
      $c->addAscendingOrderByColumn(KonversiMkPeer::MK_LAMA);
      $filterTahun = $sf_user->getAttribute('tahun',2005,'konversi_mk');
      if ( $filterTahun  ) {
          $c->add(KonversiMkPeer::TAHUN, $filterTahun);
      }
      $filterKodeJur = $sf_user->getAttribute('kode_jur',null,'konversi_mk');
      if (!$filterKodeJur)   {
          $filterKodeJur='61-61';
          $sf_user->setAttribute('kode_jur',$filterKodeJur,'konversi_mk');
      }
      $c->add(KonversiMkPeer::KODE_JUR, $filterKodeJur);
      $this->konversis = KonversiMkPeer::doSelect($c);
      unset($c);
      $this->filterTahun=$filterTahun;
      $this->filterKodeJur=$filterKodeJur;
      $mkNames=array();
      foreach($this->konversis as $k) {
          $mkNames[ $k->getMkLama() ] = $k->getMkLama();
          $mkNames[ $k->getMkBaru() ] = $k->getMkBaru();
      }
      ksort($mkNames);
      $c=new Criteria();
      $c->add( MataKuliahPeer::KODE_MK, array_keys($mkNames), Criteria::IN );
      $mks=MataKuliahPeer::doSelect($c);
      unset($c);
      foreach ($mks as $mk) {
          $mkNames[ $mk->getKodeMk() ] = $mk->getNama();
      }
      $this->mkNames=$mkNames;


  }
  public function executeFilter(sfWebRequest $request) {
      $filterKodeJur=$request->getParameter('kode_jur','61-61');
      $sf_user=$this->getUser();
      $sf_user->setAttribute('kode_jur',$filterKodeJur,'konversi_mk');
      $filterTahun=$request->getParameter('tahun','2005');
      $sf_user=$this->getUser();
      $sf_user->setAttribute('tahun',$filterTahun,'konversi_mk');
      $commit=$request->getParameter('commit','Tampilkan');
      if ($commit=='Jalankan Proses Konversi') {
        return   $this->redirect('http://'. $_SERVER['SERVER_NAME'].'/konversiMatkul.php?kode_jur='.$filterKodeJur.'&tahun='.$filterTahun );
      } else  {
        return $this->redirect('konversi/index');
      }
  }

}
