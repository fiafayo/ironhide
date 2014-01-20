<?php

/**
 * JadwalKuliah form base class.
 *
 * @method JadwalKuliah getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseJadwalKuliahForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_jadwal' => new sfWidgetFormInputHidden(),
      'kode_kelas'  => new sfWidgetFormPropelChoice(array('model' => 'KelasMK', 'add_empty' => false)),
      'kode_ruang'  => new sfWidgetFormPropelChoice(array('model' => 'Ruang', 'add_empty' => false)),
      'jam_masuk'   => new sfWidgetFormInputText(),
      'jam_keluar'  => new sfWidgetFormInputText(),
      'hari'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'kode_jadwal' => new sfValidatorPropelChoice(array('model' => 'JadwalKuliah', 'column' => 'kode_jadwal', 'required' => false)),
      'kode_kelas'  => new sfValidatorPropelChoice(array('model' => 'KelasMK', 'column' => 'kode_kelas')),
      'kode_ruang'  => new sfValidatorPropelChoice(array('model' => 'Ruang', 'column' => 'kode_ruang')),
      'jam_masuk'   => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'jam_keluar'  => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'hari'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('jadwal_kuliah[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JadwalKuliah';
  }


}
