<?php

/**
 * Ruang filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRuangFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kapasitas'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'jenis'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'kapasitas_ujian'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prioritas'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'untuk_ujian'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'ruang_block_list' => new sfWidgetFormPropelChoice(array('model' => 'JadwalUjian', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'kapasitas'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'jenis'            => new sfValidatorPass(array('required' => false)),
      'kapasitas_ujian'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'prioritas'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'untuk_ujian'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'ruang_block_list' => new sfValidatorPropelChoice(array('model' => 'JadwalUjian', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ruang_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addRuangBlockListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(RuangBlockPeer::KODE_RUANG, RuangPeer::KODE_RUANG);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(RuangBlockPeer::KODE_UJIAN, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(RuangBlockPeer::KODE_UJIAN, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Ruang';
  }

  public function getFields()
  {
    return array(
      'kode_ruang'       => 'Text',
      'kapasitas'        => 'Number',
      'jenis'            => 'Text',
      'kapasitas_ujian'  => 'Number',
      'prioritas'        => 'Number',
      'untuk_ujian'      => 'Boolean',
      'ruang_block_list' => 'ManyKey',
    );
  }
}
