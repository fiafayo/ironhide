<?php

/**
 * User form base class.
 *
 * @method User getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'peran_user_id'    => new sfWidgetFormPropelChoice(array('model' => 'PeranUser', 'add_empty' => false)),
      'instansi_id'      => new sfWidgetFormPropelChoice(array('model' => 'Instansi', 'add_empty' => true)),
      'satuan_kerja_id'  => new sfWidgetFormPropelChoice(array('model' => 'SatuanKerja', 'add_empty' => true)),
      'username'         => new sfWidgetFormInputText(),
      'nama'             => new sfWidgetFormInputText(),
      'default_password' => new sfWidgetFormInputText(),
      'password'         => new sfWidgetFormInputText(),
      'telepon'          => new sfWidgetFormInputText(),
      'alamat'           => new sfWidgetFormInputText(),
      'email'            => new sfWidgetFormInputText(),
      'public_key'       => new sfWidgetFormTextarea(),
      'disabled'         => new sfWidgetFormInputCheckbox(),
      'alasan_disabled'  => new sfWidgetFormInputText(),
      'state'            => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'peran_user_id'    => new sfValidatorPropelChoice(array('model' => 'PeranUser', 'column' => 'id')),
      'instansi_id'      => new sfValidatorPropelChoice(array('model' => 'Instansi', 'column' => 'id', 'required' => false)),
      'satuan_kerja_id'  => new sfValidatorPropelChoice(array('model' => 'SatuanKerja', 'column' => 'id', 'required' => false)),
      'username'         => new sfValidatorString(array('max_length' => 64)),
      'nama'             => new sfValidatorString(array('max_length' => 255)),
      'default_password' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'password'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'telepon'          => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'alamat'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'public_key'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'disabled'         => new sfValidatorBoolean(array('required' => false)),
      'alasan_disabled'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'state'            => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'User', 'column' => array('id'))),
        new sfValidatorPropelUnique(array('model' => 'User', 'column' => array('username'))),
      ))
    );

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }


}
