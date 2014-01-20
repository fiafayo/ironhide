<?php

/**
 * JadwalUjian form.
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class JadwalUjianForm extends BaseJadwalUjianForm
{
  public function configure()
  {
        //unset( $this['semester'], $this['tahun'] );
        $this->widgetSchema['jenis_ruang'] = new sfWidgetFormChoice(array(
            'choices' => JadwalUjianPeer::getOpsiRuangs(),
            'expanded' => false,
        ));
        $this->widgetSchema['semester'] = new sfWidgetFormChoice(array(
            'choices' => JadwalUjianPeer::getOpsiSemesters(),
            'expanded' => false,
        ));
        $this->widgetSchema['hari'] = new sfWidgetFormChoice(array(
            'choices' => array(1=>'Senin','Selasa','Rabu','Kamis','Jumat'),
            'expanded' => false,
        ));
        $this->widgetSchema['jam'] = new sfWidgetFormChoice(array(
            'choices' => array(1=>1,2,3,4),
            'expanded' => false,
        ));
        $this->widgetSchema['minggu'] = new sfWidgetFormChoice(array(
            'choices' => array(1=>'I','II'),
            'expanded' => false,
        ));


  }
}
