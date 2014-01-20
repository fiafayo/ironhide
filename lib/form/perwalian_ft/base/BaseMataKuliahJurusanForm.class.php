<?php

/**
 * MataKuliahJurusan form base class.
 *
 * @method MataKuliahJurusan getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMataKuliahJurusanForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_mk'      => new sfWidgetFormInputHidden(),
      'kode_jur'     => new sfWidgetFormInputHidden(),
      'jenis'        => new sfWidgetFormInputText(),
      'status_bebas' => new sfWidgetFormInputCheckbox(),
      'semester'     => new sfWidgetFormInputText(),
      'sks_min'      => new sfWidgetFormInputText(),
      'kurikulum'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'kode_mk'      => new sfValidatorPropelChoice(array('model' => 'MataKuliah', 'column' => 'kode_mk', 'required' => false)),
      'kode_jur'     => new sfValidatorPropelChoice(array('model' => 'Jurusan', 'column' => 'kode_jur', 'required' => false)),
      'jenis'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'status_bebas' => new sfValidatorBoolean(array('required' => false)),
      'semester'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'sks_min'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'kurikulum'    => new sfValidatorString(array('max_length' => 5, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mata_kuliah_jurusan[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MataKuliahJurusan';
  }


}
