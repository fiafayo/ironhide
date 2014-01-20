<?php

/**
 * DosenMataKuliah form base class.
 *
 * @method DosenMataKuliah getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDosenMataKuliahForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_dosen' => new sfWidgetFormInputHidden(),
      'kode_mk'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'kode_dosen' => new sfValidatorPropelChoice(array('model' => 'Dosen', 'column' => 'kode_dosen', 'required' => false)),
      'kode_mk'    => new sfValidatorPropelChoice(array('model' => 'MataKuliah', 'column' => 'kode_mk', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dosen_mata_kuliah[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DosenMataKuliah';
  }


}
