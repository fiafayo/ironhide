<?php

/**
 * JadwalRuang filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseJadwalRuangFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_ruang'    => new sfWidgetFormPropelChoice(array('model' => 'Ruang', 'add_empty' => true)),
      'hari'          => new sfWidgetFormFilterInput(),
      'jam'           => new sfWidgetFormFilterInput(),
      'minggu'        => new sfWidgetFormFilterInput(),
      'semester'      => new sfWidgetFormFilterInput(),
      'kode_karyawan' => new sfWidgetFormPropelChoice(array('model' => 'Karyawan', 'add_empty' => true)),
      'kode_dosen'    => new sfWidgetFormPropelChoice(array('model' => 'Dosen', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'kode_ruang'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Ruang', 'column' => 'kode_ruang')),
      'hari'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'jam'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'minggu'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'semester'      => new sfValidatorPass(array('required' => false)),
      'kode_karyawan' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Karyawan', 'column' => 'kode_karyawan')),
      'kode_dosen'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Dosen', 'column' => 'kode_dosen')),
    ));

    $this->widgetSchema->setNameFormat('jadwal_ruang_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JadwalRuang';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'kode_ruang'    => 'ForeignKey',
      'hari'          => 'Number',
      'jam'           => 'Number',
      'minggu'        => 'Number',
      'semester'      => 'Text',
      'kode_karyawan' => 'ForeignKey',
      'kode_dosen'    => 'ForeignKey',
    );
  }
}
