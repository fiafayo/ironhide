<?php

/**
 * Prioritas form base class.
 *
 * @method Prioritas getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePrioritasForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_prioritas' => new sfWidgetFormInputHidden(),
      'kode_fpp'       => new sfWidgetFormInputText(),
      'nama'           => new sfWidgetFormInputText(),
      'prioritas'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'kode_prioritas' => new sfValidatorPropelChoice(array('model' => 'Prioritas', 'column' => 'kode_prioritas', 'required' => false)),
      'kode_fpp'       => new sfValidatorString(array('max_length' => 20)),
      'nama'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'prioritas'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('prioritas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Prioritas';
  }


}
