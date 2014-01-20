<?php

/**
 * Prioritas filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePrioritasFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_fpp'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nama'           => new sfWidgetFormFilterInput(),
      'prioritas'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'kode_fpp'       => new sfValidatorPass(array('required' => false)),
      'nama'           => new sfValidatorPass(array('required' => false)),
      'prioritas'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('prioritas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Prioritas';
  }

  public function getFields()
  {
    return array(
      'kode_prioritas' => 'Number',
      'kode_fpp'       => 'Text',
      'nama'           => 'Text',
      'prioritas'      => 'Number',
    );
  }
}
