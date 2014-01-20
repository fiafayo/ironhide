<?php

/**
 * toefl actions.
 *
 * @package    perwalianft
 * @subpackage toefl
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class toeflActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
     $this->nrp=$request->getParameter('nrp');
     $c=new Criteria;
     if ( $this->nrp ) $c->add(LulusToeflPeer::NRP,$nrp );
     $c->add(LulusToeflPeer::LULUS,1);
     $c->addAscendingOrderByColumn(LulusToeflPeer::NRP);
     $this->toefls=LulusToeflPeer::doSelect($c);
  }
  public function executeUpdate(sfWebRequest $request)
  {
      $this->nrps=trim($request->getParameter('nrps'));
      $this->logs=array();
      if ( $request->getMethod()==sfRequest::POST )
      {

          if ( strlen($this->nrps)==0 )
          {
              $this->getUser()->setFlash('error','Isian NRP tidak boleh kosong');
              return $this->redirect('toefl/update');
          }

          $rows=explode(chr(10), $this->nrps);
          if ( is_array($rows) )
          {
              foreach ($rows as $nrp)
              {
                  $c=new Criteria;

                  $c->add(LulusToeflPeer::NRP,trim($nrp));
                  $row=LulusToeflPeer::doSelectOne($c);
                  unset($c);
                  if (!$row)
                  {
                      $row=new LulusToefl();
                      $row->setNrp(trim($nrp));
                  }
                  $row->setLulus(1);
                  $row->save();
                  $this->logs[]=$nrp;
              }

          } else {
              $c=new Criteria;
              $c->add(LulusToeflPeer::NRP,$this->nrps);
              $row=LulusToeflPeer::doSelectOne($c);
              unset($c);
              if (!$row)
              {
                  $row=new LulusToefl();
                  $row->setNrp(trim($this->nrps));
              }
              $row->setLulus(1);
              $row->save();
              $this->logs[]=$this->nrps;
          }

      }
  }

public function executeUpload(sfWebRequest $request)
  {
 
    $logs=array();
    
    if ( $request->getMethod()==sfRequest::POST ) {
        $file = $request->getFiles('csvFile');
        if ($file )
        {
            $fileName=$file['tmp_name'];
            $logs=$this->prosesCsv($fileName);
        } else {
            
        }

   }
   $this->logs=$logs;
  }
  private function prosesCsv($fileName){
    $logs=array();
    if ( !file_exists($fileName) ) {
      $logs[]='File not found';
      return $logs;
    }
    $fin=fopen($fileName,'r');
    if ($fin) {
      while (!feof($fin)) {
        $row=fgetcsv($fin,1024);
        if ( count($row) ) {
          $nrp=trim($row[0]);
          if ( strlen($nrp)==7 ) {
            $lulus=LulusToeflPeer::retrieveByPk($nrp);
            if (!$lulus) {
              $lulus=new LulusToefl;
              $lulus->setNrp($nrp);
            }
            $lulus->setLulus(1);
            $lulus->save();
            $logs[]='Sukses: '.$nrp;
          }
        }
      }
    }
    return $logs;
  }

}
