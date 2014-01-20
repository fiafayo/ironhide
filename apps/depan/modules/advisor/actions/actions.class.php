<?php

/**
 * advisor actions.
 *
 * @package    perwalianft
 * @subpackage advisor
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class advisorActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $this->nrps=trim($request->getParameter('nrps'));
      $this->logs=array();
      if ( $request->getMethod()==sfRequest::POST )
      {

          if ( strlen($this->nrps)==0 )
          {
              $this->getUser()->setFlash('error','Isian NRP tidak boleh kosong');
              return $this->redirect('advisor/index');
          }

          $rows=explode(chr(10), $this->nrps);
          if ( is_array($rows) )
          {
              foreach ($rows as $nrp)
              {
                  
                  $row=MahasiswaPeer::retrieveByPK(trim($nrp));
                  if ($row)
                  {
                      $row->setKonsultasi(1);
                      $row->save();
                      $this->logs[]=$nrp;
                  }
              }

          } else {
                  $row=MahasiswaPeer::retrieveByPK(trim($this->nrps));
                  if ($row)
                  {
                      $row->setKonsultasi(1);
                      $row->save();
                      $this->logs[]=$this->nrps;
                  }
          }
          $sf_user=$this->getUser();

          $userLog = new UserLog();
          $userLog->setAction('advisor');
          $userLog->setUsername( $sf_user->getId() );
          $userLog->setDescription( implode(',', $this->logs) );
          $userLog->setAddress( $_SERVER['REMOTE_ADDR'] );
          $userLog->setSubject('konsultasi');
          $userLog->save();
          

      }
  }
}
