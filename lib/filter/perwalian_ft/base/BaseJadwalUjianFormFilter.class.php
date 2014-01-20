<?php

/**
 * JadwalUjian filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseJadwalUjianFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_mk'             => new sfWidgetFormPropelChoice(array('model' => 'MataKuliah', 'add_empty' => true)),
      'hari'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'jam'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'minggu'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'semester'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tahun'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'jenis_ruang'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'jumlah_mhs'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'jenis_ujian'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ruang_block_list'    => new sfWidgetFormPropelChoice(array('model' => 'Ruang', 'add_empty' => true)),
      'karyawan_block_list' => new sfWidgetFormPropelChoice(array('model' => 'Karyawan', 'add_empty' => true)),
      'dosen_block_list'    => new sfWidgetFormPropelChoice(array('model' => 'Dosen', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'kode_mk'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MataKuliah', 'column' => 'kode_mk')),
      'hari'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'jam'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'minggu'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'semester'            => new sfValidatorPass(array('required' => false)),
      'tahun'               => new sfValidatorPass(array('required' => false)),
      'jenis_ruang'         => new sfValidatorPass(array('required' => false)),
      'jumlah_mhs'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'jenis_ujian'         => new sfValidatorPass(array('required' => false)),
      'ruang_block_list'    => new sfValidatorPropelChoice(array('model' => 'Ruang', 'required' => false)),
      'karyawan_block_list' => new sfValidatorPropelChoice(array('model' => 'Karyawan', 'required' => false)),
      'dosen_block_list'    => new sfValidatorPropelChoice(array('model' => 'Dosen', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('jadwal_ujian_filters[%s]');

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

    $criteria->addJoin(RuangBlockPeer::KODE_UJIAN, JadwalUjianPeer::KODE_UJIAN);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(RuangBlockPeer::KODE_RUANG, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(RuangBlockPeer::KODE_RUANG, $value));
    }

    $criteria->add($criterion);
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

    $criteria->addJoin(KaryawanBlockPeer::KODE_UJIAN, JadwalUjianPeer::KODE_UJIAN);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(KaryawanBlockPeer::KODE_KARYAWAN, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(KaryawanBlockPeer::KODE_KARYAWAN, $value));
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

    $criteria->addJoin(DosenBlockPeer::KODE_UJIAN, JadwalUjianPeer::KODE_UJIAN);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(DosenBlockPeer::KODE_DOSEN, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(DosenBlockPeer::KODE_DOSEN, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'JadwalUjian';
  }

  public function getFields()
  {
    return array(
      'kode_ujian'          => 'Text',
      'kode_mk'             => 'ForeignKey',
      'hari'                => 'Number',
      'jam'                 => 'Number',
      'minggu'              => 'Number',
      'semester'            => 'Text',
      'tahun'               => 'Text',
      'jenis_ruang'         => 'Text',
      'jumlah_mhs'          => 'Number',
      'jenis_ujian'         => 'Text',
      'ruang_block_list'    => 'ManyKey',
      'karyawan_block_list' => 'ManyKey',
      'dosen_block_list'    => 'ManyKey',
    );
  }
}
