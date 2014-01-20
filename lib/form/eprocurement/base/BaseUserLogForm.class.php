<?php

/**
 * UserLog form base class.
 *
 * @method UserLog getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseUserLogForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'username'    => new sfWidgetFormInputText(),
      'action'      => new sfWidgetFormInputText(),
      'subject'     => new sfWidgetFormInputText(),
      'address'     => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'kode_fpp'    => new sfWidgetFormInputText(),
      'kode_kelas'  => new sfWidgetFormInputText(),
      'nrp'         => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'UserLog', 'column' => 'id', 'required' => false)),
      'username'    => new sfValidatorString(array('max_length' => 60)),
      'action'      => new sfValidatorString(array('max_length' => 60)),
      'subject'     => new sfValidatorString(array('max_length' => 128)),
      'address'     => new sfValidatorString(array('max_length' => 20)),
      'description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'kode_fpp'    => new sfValidatorString(array('max_length' => 20)),
      'kode_kelas'  => new sfValidatorString(array('max_length' => 20)),
      'nrp'         => new sfValidatorString(array('max_length' => 8)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserLog';
  }


}
