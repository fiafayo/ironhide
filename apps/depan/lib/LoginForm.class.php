<?php

/**
 * Konsentrasi form base class.
 *
 * @method Konsentrasi getObject() Returns the current form's model object
 *
 * @package    heloz_if
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */


class LoginForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'            => new sfWidgetFormInputText(),
      'password'            => new sfWidgetFormInputPassword(),
    ));

    $this->setValidators(array(
      'username'            => new sfValidatorString(array('min_length' => 4, 'max_length' => 20, 'required' => true)),
      'password'            => new sfValidatorString(array('min_length' => 4, 'max_length' => 100, 'required' => true)),
    ));

    $this->widgetSchema->setNameFormat('login[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Login';
  }


}
