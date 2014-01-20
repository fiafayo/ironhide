<?php

/**
 * Dosen filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDosenFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nama'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'                 => new sfWidgetFormFilterInput(),
      'kode_jur'               => new sfWidgetFormPropelChoice(array('model' => 'Jurusan', 'add_empty' => true)),
      'is_pengawas'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'npk'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dosen_mata_kuliah_list' => new sfWidgetFormPropelChoice(array('model' => 'MataKuliah', 'add_empty' => true)),
      'dosen_kelas_list'       => new sfWidgetFormPropelChoice(array('model' => 'KelasMK', 'add_empty' => true)),
      'dosen_block_list'       => new sfWidgetFormPropelChoice(array('model' => 'JadwalUjian', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nama'                   => new sfValidatorPass(array('required' => false)),
      'status'                 => new sfValidatorPass(array('required' => false)),
      'kode_jur'               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Jurusan', 'column' => 'kode_jur')),
      'is_pengawas'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'npk'                    => new sfValidatorPass(array('required' => false)),
      'dosen_mata_kuliah_list' => new sfValidatorPropelChoice(array('model' => 'MataKuliah', 'required' => false)),
      'dosen_kelas_list'       => new sfValidatorPropelChoice(array('model' => 'KelasMK', 'required' => false)),
      'dosen_block_list'       => new sfValidatorPropelChoice(array('model' => 'JadwalUjian', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dosen_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addDosenMataKuliahListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(DosenMataKuliahPeer::KODE_DOSEN, DosenPeer::KODE_DOSEN);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(DosenMataKuliahPeer::KODE_MK, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(DosenMataKuliahPeer::KODE_MK, $value));
    }

    $criteria->add($criterion);
  }

  public function addDosenKelasListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(DosenKelasPeer::KODE_DOSEN, DosenPeer::KODE_DOSEN);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(DosenKelasPeer::KODE_KELAS, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(DosenKelasPeer::KODE_KELAS, $value));
    }

    $criteria->add($criterion);
  }

  public function addDosenBlockListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(DosenBlockPeer::KODE_DOSEN, DosenPeer::KODE_DOSEN);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(DosenBlockPeer::KODE_UJIAN, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(DosenBlockPeer::KODE_UJIAN, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Dosen';
  }

  public function getFields()
  {
    return array(
      'kode_dosen'             => 'Text',
      'nama'                   => 'Text',
      'status'                 => 'Text',
      'kode_jur'               => 'ForeignKey',
      'is_pengawas'            => 'Boolean',
      'npk'                    => 'Text',
      'dosen_mata_kuliah_list' => 'ManyKey',
      'dosen_kelas_list'       => 'ManyKey',
      'dosen_block_list'       => 'ManyKey',
    );
  }
}
