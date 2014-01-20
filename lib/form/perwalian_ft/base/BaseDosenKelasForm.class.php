<?php

/**
 * DosenKelas form base class.
 *
 * @method DosenKelas getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDosenKelasForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_dosen' => new sfWidgetFormInputHidden(),
      'kode_kelas' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'kode_dosen' => new sfValidatorPropelChoice(array('model' => 'Dosen', 'column' => 'kode_dosen', 'required' => false)),
      'kode_kelas' => new sfValidatorPropelChoice(array('model' => 'KelasMK', 'column' => 'kode_kelas', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dosen_kelas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DosenKelas';
  }


}
