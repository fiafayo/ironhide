<?php

/**
 * MinatMataKuliah form base class.
 *
 * @method MinatMataKuliah getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMinatMataKuliahForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nrp'      => new sfWidgetFormInputHidden(),
      'kode_mk'  => new sfWidgetFormInputHidden(),
      'angkatan' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'nrp'      => new sfValidatorPropelChoice(array('model' => 'Mahasiswa', 'column' => 'nrp', 'required' => false)),
      'kode_mk'  => new sfValidatorPropelChoice(array('model' => 'MataKuliah', 'column' => 'kode_mk', 'required' => false)),
      'angkatan' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('minat_mata_kuliah[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MinatMataKuliah';
  }


}
