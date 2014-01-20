<?php

/**
 * JadwalRuang form base class.
 *
 * @method JadwalRuang getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseJadwalRuangForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'kode_ruang'    => new sfWidgetFormPropelChoice(array('model' => 'Ruang', 'add_empty' => false)),
      'hari'          => new sfWidgetFormInputText(),
      'jam'           => new sfWidgetFormInputText(),
      'minggu'        => new sfWidgetFormInputText(),
      'semester'      => new sfWidgetFormInputText(),
      'kode_karyawan' => new sfWidgetFormPropelChoice(array('model' => 'Karyawan', 'add_empty' => true)),
      'kode_dosen'    => new sfWidgetFormPropelChoice(array('model' => 'Dosen', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'JadwalRuang', 'column' => 'id', 'required' => false)),
      'kode_ruang'    => new sfValidatorPropelChoice(array('model' => 'Ruang', 'column' => 'kode_ruang')),
      'hari'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'jam'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'minggu'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'semester'      => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'kode_karyawan' => new sfValidatorPropelChoice(array('model' => 'Karyawan', 'column' => 'kode_karyawan', 'required' => false)),
      'kode_dosen'    => new sfValidatorPropelChoice(array('model' => 'Dosen', 'column' => 'kode_dosen', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('jadwal_ruang[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JadwalRuang';
  }


}
