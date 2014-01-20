<?php

require_once dirname(__FILE__).'/../lib/semesterGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/semesterGeneratorHelper.class.php';

/**
 * semester actions.
 *
 * @package    perwalianft
 * @subpackage semester
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class semesterActions extends autoSemesterActions
{
    public function executeProsesBio()
    {
        $logs=array();
        SinkronisasiUbaya::sinkronisasiSemuaMahasiswa($logs);
        $this->logs=$logs;

    }
    public function executeShow()
    {
        return $this->forward('semester','prosesBio');
    }
}
