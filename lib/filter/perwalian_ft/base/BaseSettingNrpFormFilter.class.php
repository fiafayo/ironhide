<?php

/**
 * SettingNrp filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSettingNrpFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nrp_awal'   => new sfWidgetFormFilterInput(),
      'nrp_akhir'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nrp_awal'   => new sfValidatorPass(array('required' => false)),
      'nrp_akhir'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('setting_nrp_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SettingNrp';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Text',
      'kode_kelas' => 'ForeignKey',
      'nrp_awal'   => 'Text',
      'nrp_akhir'  => 'Text',
    );
  }
}
