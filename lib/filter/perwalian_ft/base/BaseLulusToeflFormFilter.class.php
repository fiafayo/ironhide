<?php

/**
 * LulusToefl filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseLulusToeflFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'lulus' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'lulus' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('lulus_toefl_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LulusToefl';
  }

  public function getFields()
  {
    return array(
      'nrp'   => 'ForeignKey',
      'lulus' => 'Number',
    );
  }
}
