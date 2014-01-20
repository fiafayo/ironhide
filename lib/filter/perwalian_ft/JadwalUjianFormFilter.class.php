<?php

/**
 * JadwalUjian filter form.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class JadwalUjianFormFilter extends BaseJadwalUjianFormFilter
{
  public function configure()
  {
        unset( $this['semester'], $this['tahun'] );
        $this->widgetSchema['jenis_ruang'] = new sfWidgetFormChoice(array(
            'choices' => JadwalUjianPeer::getOpsiRuangs(),
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
