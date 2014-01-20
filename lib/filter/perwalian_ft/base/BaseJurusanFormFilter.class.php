<?php

/**
 * Jurusan filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseJurusanFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nama'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mata_kuliah_jurusan_list' => new sfWidgetFormPropelChoice(array('model' => 'MataKuliah', 'add_empty' => true)),
      'kelas_jurusan_list'       => new sfWidgetFormPropelChoice(array('model' => 'KelasMK', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nama'                     => new sfValidatorPass(array('required' => false)),
      'mata_kuliah_jurusan_list' => new sfValidatorPropelChoice(array('model' => 'MataKuliah', 'required' => false)),
      'kelas_jurusan_list'       => new sfValidatorPropelChoice(array('model' => 'KelasMK', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('jurusan_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
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

    $criteria->addJoin(MataKuliahJurusanPeer::KODE_JUR, JurusanPeer::KODE_JUR);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(MataKuliahJurusanPeer::KODE_MK, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(MataKuliahJurusanPeer::KODE_MK, $value));
    }

    $criteria->add($criterion);
  }

  public function addKelasJurusanListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(KelasJurusanPeer::KODE_JUR, JurusanPeer::KODE_JUR);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(KelasJurusanPeer::KODE_KELAS, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(KelasJurusanPeer::KODE_KELAS, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Jurusan';
  }

  public function getFields()
  {
    return array(
      'kode_jur'                 => 'Text',
      'nama'                     => 'Text',
      'mata_kuliah_jurusan_list' => 'ManyKey',
      'kelas_jurusan_list'       => 'ManyKey',
    );
  }
}
