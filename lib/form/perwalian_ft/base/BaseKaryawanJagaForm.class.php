<?php

/**
 * KaryawanJaga form base class.
 *
 * @method KaryawanJaga getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseKaryawanJagaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_karyawan' => new sfWidgetFormInputHidden(),
      'kode_ujian'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'kode_karyawan' => new sfValidatorPropelChoice(array('model' => 'Karyawan', 'column' => 'kode_karyawan', 'required' => false)),
      'kode_ujian'    => new sfValidatorPropelChoice(array('model' => 'JadwalUjian', 'column' => 'kode_ujian', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('karyawan_jaga[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'KaryawanJaga';
  }


}
