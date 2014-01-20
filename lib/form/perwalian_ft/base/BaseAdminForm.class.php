<?php

/**
 * Admin form base class.
 *
 * @method Admin getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAdminForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nik'      => new sfWidgetFormInputHidden(),
      'nama'     => new sfWidgetFormInputText(),
      'kode_jur' => new sfWidgetFormPropelChoice(array('model' => 'Jurusan', 'add_empty' => true)),
      'password' => new sfWidgetFormInputText(),
      'jabatan'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'nik'      => new sfValidatorPropelChoice(array('model' => 'Admin', 'column' => 'nik', 'required' => false)),
      'nama'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'kode_jur' => new sfValidatorPropelChoice(array('model' => 'Jurusan', 'column' => 'kode_jur', 'required' => false)),
      'password' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'jabatan'  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('admin[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Admin';
  }


}
