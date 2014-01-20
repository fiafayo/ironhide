<?php

require_once dirname(__FILE__).'/../lib/baak_mahasiswaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/baak_mahasiswaGeneratorHelper.class.php';

/**
 * baak_mahasiswa actions.
 *
 * @package    perwalianft
 * @subpackage baak_mahasiswa
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class baak_mahasiswaActions extends autoBaak_mahasiswaActions
{
    public function executeList_transkrip( sfWebRequest $request ) {
        $nrp=$this->getRequestParameter('nrp');
        $this->mhs=BaakMahasiswaPeer::retrieveByPK($nrp);
        $this->forward404Unless($this->mhs);
        $c=new Criteria();
        $c->addAscendingOrderByColumn(MhsTranskripPeer::THNAKADEMIK);
        $c->addAscendingOrderByColumn(MhsTranskripPeer::SEMESTER);
        $c->addAscendingOrderByColumn(MhsTranskripPeer::KODEMK);
        $c->addAscendingOrderByColumn(MhsTranskripPeer::KODENISBI);
        $transkrips=$mhs->getMhstranskrips($c);
        $rows=array();
        foreach($transkrips as $row) {
            $rows[]=$row->toArray();
        }

        $this->data=array(
            'transkrips'=>$rows,
        );

    }
}
