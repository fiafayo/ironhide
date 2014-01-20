<?php

/**
 * transkrip actions.
 *
 * @package    perwalianft
 * @subpackage transkrip
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class transkripActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('transkrip', 'tambahKonversi');
  }
  public function executeTambahKonversi(sfWebRequest $request)
  {
        $c=new Criteria();
        $c->addAscendingOrderByColumn( MataKuliahPeer::KODE_MK );
        $matkuls=MataKuliahPeer::doSelect($c);
        $mataKuliahs=array();
        foreach ($matkuls as $matkul)
        {
            $mataKuliahs[$matkul->getKodeMk()]=$matkul->getNama();
        }
        $this->mataKuliahs=$mataKuliahs;
        $logs=array();
      if ( $request->getMethod()==sfRequest::POST )
      {
          $mk_asal=$request->getParameter('mk_asal');
          $mk_hasil=$request->getParameter('mk_hasil');
          if ($mk_asal!=$mk_hasil)
          {
            $tambahList=array( $mk_asal=>$mk_hasil );
            $logs=KonversiTranskrip::tambahKonversiMK($tambahList);
          } else {
              $logs[]='Kode mata kuliah asal dan hasil tidak boleh sama!';
          }

      }
      $this->logs=$logs;
      
  }
}
