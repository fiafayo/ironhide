<?php

/**
 * JadwalKuliah filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseJadwalKuliahFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_kelas'  => new sfWidgetFormPropelChoice(array('model' => 'KelasMK', 'add_empty' => true)),
      'kode_ruang'  => new sfWidgetFormPropelChoice(array('model' => 'Ruang', 'add_empty' => true)),
      'jam_masuk'   => new sfWidgetFormFilterInput(),
      'jam_keluar'  => new sfWidgetFormFilterInput(),
      'hari'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'kode_kelas'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'KelasMK', 'column' => 'kode_kelas')),
      'kode_ruang'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Ruang', 'column' => 'kode_ruang')),
      'jam_masuk'   => new sfValidatorPass(array('required' => false)),
      'jam_keluar'  => new sfValidatorPass(array('required' => false)),
      'hari'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('jadwal_kuliah_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JadwalKuliah';
  }

  public function getFields()
  {
    return array(
      'kode_jadwal' => 'Text',
      'kode_kelas'  => 'ForeignKey',
      'kode_ruang'  => 'ForeignKey',
      'jam_masuk'   => 'Text',
      'jam_keluar'  => 'Text',
      'hari'        => 'Number',
    );
  }
}
