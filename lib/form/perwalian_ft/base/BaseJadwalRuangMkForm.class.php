<?php

/**
 * JadwalRuangMk form base class.
 *
 * @method JadwalRuangMk getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseJadwalRuangMkForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'jadwal_ruang_id' => new sfWidgetFormPropelChoice(array('model' => 'JadwalRuang', 'add_empty' => false)),
      'kode_kelas'      => new sfWidgetFormPropelChoice(array('model' => 'KelasMK', 'add_empty' => false)),
      'kapasitas'       => new sfWidgetFormInputText(),
      'kp'              => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'JadwalRuangMk', 'column' => 'id', 'required' => false)),
      'jadwal_ruang_id' => new sfValidatorPropelChoice(array('model' => 'JadwalRuang', 'column' => 'id')),
      'kode_kelas'      => new sfValidatorPropelChoice(array('model' => 'KelasMK', 'column' => 'kode_kelas')),
      'kapasitas'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'kp'              => new sfValidatorString(array('max_length' => 2, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('jadwal_ruang_mk[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JadwalRuangMk';
  }


}
