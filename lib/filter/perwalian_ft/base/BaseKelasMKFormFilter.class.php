<?php

/**
 * KelasMK filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseKelasMKFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_mk'            => new sfWidgetFormPropelChoice(array('model' => 'MataKuliah', 'add_empty' => true)),
      'kp'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'isi'                => new sfWidgetFormFilterInput(),
      'kapasitas'          => new sfWidgetFormFilterInput(),
      'semester'           => new sfWidgetFormFilterInput(),
      'tahun'              => new sfWidgetFormFilterInput(),
      'status_buka'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'dmb'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'waktu_buka'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'dosen_kelas_list'   => new sfWidgetFormPropelChoice(array('model' => 'Dosen', 'add_empty' => true)),
      'daftar_kelas_list'  => new sfWidgetFormPropelChoice(array('model' => 'FPP', 'add_empty' => true)),
      'kelas_jurusan_list' => new sfWidgetFormPropelChoice(array('model' => 'Jurusan', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'kode_mk'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MataKuliah', 'column' => 'kode_mk')),
      'kp'                 => new sfValidatorPass(array('required' => false)),
      'isi'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'kapasitas'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'semester'           => new sfValidatorPass(array('required' => false)),
      'tahun'              => new sfValidatorPass(array('required' => false)),
      'status_buka'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'dmb'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'waktu_buka'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'dosen_kelas_list'   => new sfValidatorPropelChoice(array('model' => 'Dosen', 'required' => false)),
      'daftar_kelas_list'  => new sfValidatorPropelChoice(array('model' => 'FPP', 'required' => false)),
      'kelas_jurusan_list' => new sfValidatorPropelChoice(array('model' => 'Jurusan', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('kelas_mk_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
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

    $criteria->addJoin(DosenKelasPeer::KODE_KELAS, KelasMKPeer::KODE_KELAS);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(DosenKelasPeer::KODE_DOSEN, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(DosenKelasPeer::KODE_DOSEN, $value));
    }

    $criteria->add($criterion);
  }

  public function addDaftarKelasListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(DaftarKelasPeer::KODE_KELAS, KelasMKPeer::KODE_KELAS);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(DaftarKelasPeer::KODE_FPP, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(DaftarKelasPeer::KODE_FPP, $value));
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

    $criteria->addJoin(KelasJurusanPeer::KODE_KELAS, KelasMKPeer::KODE_KELAS);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(KelasJurusanPeer::KODE_JUR, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(KelasJurusanPeer::KODE_JUR, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'KelasMK';
  }

  public function getFields()
  {
    return array(
      'kode_kelas'         => 'Text',
      'kode_mk'            => 'ForeignKey',
      'kp'                 => 'Text',
      'isi'                => 'Number',
      'kapasitas'          => 'Number',
      'semester'           => 'Text',
      'tahun'              => 'Text',
      'status_buka'        => 'Boolean',
      'dmb'                => 'Boolean',
      'waktu_buka'         => 'Date',
      'dosen_kelas_list'   => 'ManyKey',
      'daftar_kelas_list'  => 'ManyKey',
      'kelas_jurusan_list' => 'ManyKey',
    );
  }
}
