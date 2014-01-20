<?php

/**
 * Instansi filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInstansiFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kategori_instansi_id' => new sfWidgetFormPropelChoice(array('model' => 'KategoriInstansi', 'add_empty' => true)),
      'nama'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'state'                => new sfWidgetFormFilterInput(),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'kategori_instansi_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'KategoriInstansi', 'column' => 'id')),
      'nama'                 => new sfValidatorPass(array('required' => false)),
      'state'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('instansi_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Instansi';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'kategori_instansi_id' => 'ForeignKey',
      'nama'                 => 'Text',
      'state'                => 'Number',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
