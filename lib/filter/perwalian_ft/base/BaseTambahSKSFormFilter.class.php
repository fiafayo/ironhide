<?php

/**
 * TambahSKS filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTambahSKSFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nrp'        => new sfWidgetFormPropelChoice(array('model' => 'Mahasiswa', 'add_empty' => true)),
      'jml_sks'    => new sfWidgetFormFilterInput(),
      'keterangan' => new sfWidgetFormFilterInput(),
      'semester'   => new sfWidgetFormFilterInput(),
      'tahun'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nrp'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Mahasiswa', 'column' => 'nrp')),
      'jml_sks'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'keterangan' => new sfValidatorPass(array('required' => false)),
      'semester'   => new sfValidatorPass(array('required' => false)),
      'tahun'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tambah_sks_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TambahSKS';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Text',
      'nrp'        => 'ForeignKey',
      'jml_sks'    => 'Number',
      'keterangan' => 'Text',
      'semester'   => 'Text',
      'tahun'      => 'Text',
    );
  }
}
