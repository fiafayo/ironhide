<?php

/**
 * DaftarKelas form base class.
 *
 * @method DaftarKelas getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDaftarKelasForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_fpp'   => new sfWidgetFormInputHidden(),
      'kode_kelas' => new sfWidgetFormInputHidden(),
      'nrp'        => new sfWidgetFormInputHidden(),
      'status'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'kode_fpp'   => new sfValidatorPropelChoice(array('model' => 'FPP', 'column' => 'kode_fpp', 'required' => false)),
      'kode_kelas' => new sfValidatorPropelChoice(array('model' => 'KelasMK', 'column' => 'kode_kelas', 'required' => false)),
      'nrp'        => new sfValidatorPropelChoice(array('model' => 'Mahasiswa', 'column' => 'nrp', 'required' => false)),
      'status'     => new sfValidatorString(array('max_length' => 2, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('daftar_kelas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DaftarKelas';
  }


}
