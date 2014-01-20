<?php

/**
 * MataKuliah filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMataKuliahFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nama'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sks'                      => new sfWidgetFormFilterInput(),
      'transkrip_asli_list'      => new sfWidgetFormPropelChoice(array('model' => 'Mahasiswa', 'add_empty' => true)),
      'mata_kuliah_jurusan_list' => new sfWidgetFormPropelChoice(array('model' => 'Jurusan', 'add_empty' => true)),
      'transkrip_list'           => new sfWidgetFormPropelChoice(array('model' => 'Mahasiswa', 'add_empty' => true)),
      'dosen_mata_kuliah_list'   => new sfWidgetFormPropelChoice(array('model' => 'Dosen', 'add_empty' => true)),
      'minat_mata_kuliah_list'   => new sfWidgetFormPropelChoice(array('model' => 'Mahasiswa', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nama'                     => new sfValidatorPass(array('required' => false)),
      'sks'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'transkrip_asli_list'      => new sfValidatorPropelChoice(array('model' => 'Mahasiswa', 'required' => false)),
      'mata_kuliah_jurusan_list' => new sfValidatorPropelChoice(array('model' => 'Jurusan', 'required' => false)),
      'transkrip_list'           => new sfValidatorPropelChoice(array('model' => 'Mahasiswa', 'required' => false)),
      'dosen_mata_kuliah_list'   => new sfValidatorPropelChoice(array('model' => 'Dosen', 'required' => false)),
      'minat_mata_kuliah_list'   => new sfValidatorPropelChoice(array('model' => 'Mahasiswa', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mata_kuliah_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addTranskripAsliListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(TranskripAsliPeer::KODE_MK, MataKuliahPeer::KODE_MK);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(TranskripAsliPeer::NRP, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(TranskripAsliPeer::NRP, $value));
    }

    $criteria->add($criterion);
  }

  public function addMataKuliahJurusanListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(MataKuliahJurusanPeer::KODE_MK, MataKuliahPeer::KODE_MK);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(MataKuliahJurusanPeer::KODE_JUR, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(MataKuliahJurusanPeer::KODE_JUR, $value));
    }

    $criteria->add($criterion);
  }

  public function addTranskripListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(TranskripPeer::KODE_MK, MataKuliahPeer::KODE_MK);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(TranskripPeer::NRP, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(TranskripPeer::NRP, $value));
    }

    $criteria->add($criterion);
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

    $criteria->addJoin(DosenMataKuliahPeer::KODE_MK, MataKuliahPeer::KODE_MK);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(DosenMataKuliahPeer::KODE_DOSEN, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(DosenMataKuliahPeer::KODE_DOSEN, $value));
    }

    $criteria->add($criterion);
  }

  public function addMinatMataKuliahListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(MinatMataKuliahPeer::KODE_MK, MataKuliahPeer::KODE_MK);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(MinatMataKuliahPeer::NRP, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(MinatMataKuliahPeer::NRP, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'MataKuliah';
  }

  public function getFields()
  {
    return array(
      'kode_mk'                  => 'Text',
      'nama'                     => 'Text',
      'sks'                      => 'Number',
      'transkrip_asli_list'      => 'ManyKey',
      'mata_kuliah_jurusan_list' => 'ManyKey',
      'transkrip_list'           => 'ManyKey',
      'dosen_mata_kuliah_list'   => 'ManyKey',
      'minat_mata_kuliah_list'   => 'ManyKey',
    );
  }
}
