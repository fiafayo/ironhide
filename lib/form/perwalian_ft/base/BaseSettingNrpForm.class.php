<?php

/**
 * SettingNrp form base class.
 *
 * @method SettingNrp getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSettingNrpForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'kode_kelas' => new sfWidgetFormInputHidden(),
      'nrp_awal'   => new sfWidgetFormInputText(),
      'nrp_akhir'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'SettingNrp', 'column' => 'id', 'required' => false)),
      'kode_kelas' => new sfValidatorPropelChoice(array('model' => 'KelasMK', 'column' => 'kode_kelas', 'required' => false)),
      'nrp_awal'   => new sfValidatorString(array('max_length' => 8, 'required' => false)),
      'nrp_akhir'  => new sfValidatorString(array('max_length' => 8, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('setting_nrp[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SettingNrp';
  }


}
