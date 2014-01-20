<?php

/**
 * JadwalRuangMk filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseJadwalRuangMkFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'jadwal_ruang_id' => new sfWidgetFormPropelChoice(array('model' => 'JadwalRuang', 'add_empty' => true)),
      'kode_kelas'      => new sfWidgetFormPropelChoice(array('model' => 'KelasMK', 'add_empty' => true)),
      'kapasitas'       => new sfWidgetFormFilterInput(),
      'kp'              => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'jadwal_ruang_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'JadwalRuang', 'column' => 'id')),
      'kode_kelas'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'KelasMK', 'column' => 'kode_kelas')),
      'kapasitas'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'kp'              => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('jadwal_ruang_mk_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JadwalRuangMk';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'jadwal_ruang_id' => 'ForeignKey',
      'kode_kelas'      => 'ForeignKey',
      'kapasitas'       => 'Number',
      'kp'              => 'Text',
    );
  }
}
