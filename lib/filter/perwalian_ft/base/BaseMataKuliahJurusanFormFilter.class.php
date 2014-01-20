<?php

/**
 * MataKuliahJurusan filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMataKuliahJurusanFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'jenis'        => new sfWidgetFormFilterInput(),
      'status_bebas' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'semester'     => new sfWidgetFormFilterInput(),
      'sks_min'      => new sfWidgetFormFilterInput(),
      'kurikulum'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'jenis'        => new sfValidatorPass(array('required' => false)),
      'status_bebas' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'semester'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sks_min'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'kurikulum'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mata_kuliah_jurusan_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MataKuliahJurusan';
  }

  public function getFields()
  {
    return array(
      'kode_mk'      => 'ForeignKey',
      'kode_jur'     => 'ForeignKey',
      'jenis'        => 'Text',
      'status_bebas' => 'Boolean',
      'semester'     => 'Number',
      'sks_min'      => 'Number',
      'kurikulum'    => 'Text',
    );
  }
}
