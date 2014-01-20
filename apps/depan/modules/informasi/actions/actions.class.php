<?php

/**
 * informasi actions.
 *
 * @package    perwalianft
 * @subpackage informasi
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class informasiActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->criteria=new Criteria;
    $this->criteria->addDescendingOrderByColumn(InformasiPeer::UPDATED_AT);
    $this->criteria->add(InformasiPeer::UMUM,1);
    //$this->criteria->add(InformasiPeer::STATE,1,Criteria::NOT_EQUAL);
    $this->pager = new sfPropelPager('Informasi', sfConfig::get('app_max_informasi_homepage',10) );
    $this->pager->setCriteria($this->criteria);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }
}
