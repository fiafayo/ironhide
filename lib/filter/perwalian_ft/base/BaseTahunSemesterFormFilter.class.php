<?php

/**
 * TahunSemester filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTahunSemesterFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'semester' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tahun'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_aktif' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'semester' => new sfValidatorPass(array('required' => false)),
      'tahun'    => new sfValidatorPass(array('required' => false)),
      'is_aktif' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('tahun_semester_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TahunSemester';
  }

  public function getFields()
  {
    return array(
      'kode'     => 'Text',
      'semester' => 'Text',
      'tahun'    => 'Text',
      'is_aktif' => 'Boolean',
    );
  }
}
