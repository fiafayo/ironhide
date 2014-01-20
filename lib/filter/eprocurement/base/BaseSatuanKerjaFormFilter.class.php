<?php

/**
 * SatuanKerja filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSatuanKerjaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'instansi_id' => new sfWidgetFormPropelChoice(array('model' => 'Instansi', 'add_empty' => true)),
      'kode'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nama'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'alamat'      => new sfWidgetFormFilterInput(),
      'telepon'     => new sfWidgetFormFilterInput(),
      'email'       => new sfWidgetFormFilterInput(),
      'state'       => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'instansi_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Instansi', 'column' => 'id')),
      'kode'        => new sfValidatorPass(array('required' => false)),
      'nama'        => new sfValidatorPass(array('required' => false)),
      'alamat'      => new sfValidatorPass(array('required' => false)),
      'telepon'     => new sfValidatorPass(array('required' => false)),
      'email'       => new sfValidatorPass(array('required' => false)),
      'state'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('satuan_kerja_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SatuanKerja';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'instansi_id' => 'ForeignKey',
      'kode'        => 'Text',
      'nama'        => 'Text',
      'alamat'      => 'Text',
      'telepon'     => 'Text',
      'email'       => 'Text',
      'state'       => 'Number',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
