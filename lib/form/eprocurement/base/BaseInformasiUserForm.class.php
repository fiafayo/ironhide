<?php

/**
 * InformasiUser form base class.
 *
 * @method InformasiUser getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInformasiUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'informasi_id' => new sfWidgetFormInputHidden(),
      'user_id'      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'informasi_id' => new sfValidatorPropelChoice(array('model' => 'Informasi', 'column' => 'id', 'required' => false)),
      'user_id'      => new sfValidatorPropelChoice(array('model' => 'PeranUser', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('informasi_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InformasiUser';
  }


}
