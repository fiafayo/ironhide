<?php

/**
 * Instansi form base class.
 *
 * @method Instansi getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInstansiForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'kategori_instansi_id' => new sfWidgetFormPropelChoice(array('model' => 'KategoriInstansi', 'add_empty' => false)),
      'nama'                 => new sfWidgetFormTextarea(),
      'state'                => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorPropelChoice(array('model' => 'Instansi', 'column' => 'id', 'required' => false)),
      'kategori_instansi_id' => new sfValidatorPropelChoice(array('model' => 'KategoriInstansi', 'column' => 'id')),
      'nama'                 => new sfValidatorString(),
      'state'                => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'           => new sfValidatorDateTime(array('required' => false)),
      'updated_at'           => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('instansi[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Instansi';
  }


}
