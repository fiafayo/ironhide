<?php

/**
 * SatuanKerja form base class.
 *
 * @method SatuanKerja getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSatuanKerjaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'instansi_id' => new sfWidgetFormPropelChoice(array('model' => 'Instansi', 'add_empty' => false)),
      'kode'        => new sfWidgetFormTextarea(),
      'nama'        => new sfWidgetFormTextarea(),
      'alamat'      => new sfWidgetFormTextarea(),
      'telepon'     => new sfWidgetFormTextarea(),
      'email'       => new sfWidgetFormTextarea(),
      'state'       => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'SatuanKerja', 'column' => 'id', 'required' => false)),
      'instansi_id' => new sfValidatorPropelChoice(array('model' => 'Instansi', 'column' => 'id')),
      'kode'        => new sfValidatorString(),
      'nama'        => new sfValidatorString(),
      'alamat'      => new sfValidatorString(array('required' => false)),
      'telepon'     => new sfValidatorString(array('required' => false)),
      'email'       => new sfValidatorString(array('required' => false)),
      'state'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('satuan_kerja[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SatuanKerja';
  }


}
