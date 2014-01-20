<?php

/**
 * cekpin actions.
 *
 * @package    perwalianft
 * @subpackage cekpin
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cekpinActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
        $n=$request->getParameter('n');
        $p=$request->getParameter('p');
        $k=$request->getParameter('k');

        $keyAll=md5($n.'ftubaya'.$p);
        $indices=array(2,3,5,7,11,13);
        $key='';
        foreach ($indices as $idx) {
            $key.=substr($keyAll,$idx-1,1);
        }
        
        $result=array(
            'kode'=>0,
            'msg'=>'FAIL',
            'data'=>array()
        );

        if ($k==$key) {

            $c=new Criteria();
            $c->add(BaakMahasiswaPeer::NRP, $n );
            $c->add(BaakMahasiswaPeer::PIN, $p );
            $mhs=BaakMahasiswaPeer::doSelectOne($c);
            if ($mhs) {
                $result['kode']=1;
                $result['msg']='OK';
                $result['data']=$mhs->toArray();
            }
        } else {
            $result['msg']="WRONG KEY  $k instead of $key from $keyAll";
        }

        $this->setLayout(false);
        $this->data=array('result'=>$result);
        $this->getResponse()->setContentType('text/plain');
        return $this->renderText( json_encode($result) );

        //TEST DATA pin=18839727  nrp=6128083  md5('6128083ftubaya18839727') = 611719f80a86708110bb7336a7c6a2dd
        //611719f80a86708110bb7336a7c6a2dd
        // 23 5 7   1113      
        //key=111f87
        //http://perwalianft.ubaya.ac.id/cekpin?n=6128083&p=18839727&k=111f87
        
        //nrp=6001005  pin=38895606 md5('6001005ftubaya38895606')=8b6212e84b76f85b774a0034846d0fd2
        //8b6212e84b76f85b774a0034846d0fd2
        // 23 5 7   1113 
        //key=b61e7f
        //http://perwalianft.ubaya.ac.id/cekpin?n=6001005&p=38895606&k=b61e7f
  }
}
