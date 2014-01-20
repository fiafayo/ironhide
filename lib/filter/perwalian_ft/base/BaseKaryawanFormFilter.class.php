<?php

/**
 * Karyawan filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseKaryawanFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nama'                => new sfWidgetFormFilterInput(),
      'kode_jur'            => new sfWidgetFormPropelChoice(array('model' => 'Jurusan', 'add_empty' => true)),
      'is_pengawas'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'karyawan_block_list' => new sfWidgetFormPropelChoice(array('model' => 'JadwalUjian', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nama'                => new sfValidatorPass(array('required' => false)),
      'kode_jur'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Jurusan', 'column' => 'kode_jur')),
      'is_pengawas'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'karyawan_block_list' => new sfValidatorPropelChoice(array('model' => 'JadwalUjian', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('karyawan_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addKaryawanBlockListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(KaryawanBlockPeer::KODE_KARYAWAN, KaryawanPeer::KODE_KARYAWAN);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(KaryawanBlockPeer::KODE_UJIAN, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(KaryawanBlockPeer::KODE_UJIAN, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Karyawan';
  }

  public function getFields()
  {
    return array(
      'kode_karyawan'       => 'Text',
      'nama'                => 'Text',
      'kode_jur'            => 'ForeignKey',
      'is_pengawas'         => 'Boolean',
      'karyawan_block_list' => 'ManyKey',
    );
  }
}
