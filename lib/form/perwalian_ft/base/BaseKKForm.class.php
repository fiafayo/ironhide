<?php

/**
 * KK form base class.
 *
 * @method KK getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseKKForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_fpp'  => new sfWidgetFormInputHidden(),
      'jwd_kul'   => new sfWidgetFormInputText(),
      'jwd_ujian' => new sfWidgetFormInputText(),
      'mk_p'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'kode_fpp'  => new sfValidatorPropelChoice(array('model' => 'KK', 'column' => 'kode_fpp', 'required' => false)),
      'jwd_kul'   => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'jwd_ujian' => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'mk_p'      => new sfValidatorString(array('max_length' => 1, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('kk[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'KK';
  }


}
