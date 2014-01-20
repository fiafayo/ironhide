<?php

/**
 * BaakMahasiswa filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBaakMahasiswaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'Pin'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Nama'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'KodeStatus'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'IPKDenganE'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'IPKTanpaE'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'IPSAkhir'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'SksMaxDepan'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'SKSKumTanpaE' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'Pin'          => new sfValidatorPass(array('required' => false)),
      'Nama'         => new sfValidatorPass(array('required' => false)),
      'KodeStatus'   => new sfValidatorPass(array('required' => false)),
      'IPKDenganE'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'IPKTanpaE'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'IPSAkhir'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'SksMaxDepan'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'SKSKumTanpaE' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('baak_mahasiswa_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BaakMahasiswa';
  }

  public function getFields()
  {
    return array(
      'NRP'          => 'Text',
      'Pin'          => 'Text',
      'Nama'         => 'Text',
      'KodeStatus'   => 'Text',
      'IPKDenganE'   => 'Number',
      'IPKTanpaE'    => 'Number',
      'IPSAkhir'     => 'Number',
      'SksMaxDepan'  => 'Number',
      'SKSKumTanpaE' => 'Number',
    );
  }
}
