<?php

/**
 * Mahasiswa filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMahasiswaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'sksmax'                 => new sfWidgetFormFilterInput(),
      'ips'                    => new sfWidgetFormFilterInput(),
      'status'                 => new sfWidgetFormFilterInput(),
      'jurusan'                => new sfWidgetFormFilterInput(),
      'nama'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'alamat'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tgllahir'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'tmplahir'               => new sfWidgetFormFilterInput(),
      'totbss'                 => new sfWidgetFormFilterInput(),
      'ipk'                    => new sfWidgetFormFilterInput(),
      'skskum'                 => new sfWidgetFormFilterInput(),
      'telepon'                => new sfWidgetFormFilterInput(),
      'password'               => new sfWidgetFormFilterInput(),
      'angkatan'               => new sfWidgetFormFilterInput(),
      'namasma'                => new sfWidgetFormFilterInput(),
      'namaortu'               => new sfWidgetFormFilterInput(),
      'kelamin'                => new sfWidgetFormFilterInput(),
      'asisten'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'konsultasi'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'aa'                     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'transkrip_asli_list'    => new sfWidgetFormPropelChoice(array('model' => 'MataKuliah', 'add_empty' => true)),
      'transkrip_list'         => new sfWidgetFormPropelChoice(array('model' => 'MataKuliah', 'add_empty' => true)),
      'minat_mata_kuliah_list' => new sfWidgetFormPropelChoice(array('model' => 'MataKuliah', 'add_empty' => true)),
      'daftar_kelas_list'      => new sfWidgetFormPropelChoice(array('model' => 'FPP', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'sksmax'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ips'                    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'status'                 => new sfValidatorPass(array('required' => false)),
      'jurusan'                => new sfValidatorPass(array('required' => false)),
      'nama'                   => new sfValidatorPass(array('required' => false)),
      'alamat'                 => new sfValidatorPass(array('required' => false)),
      'tgllahir'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'tmplahir'               => new sfValidatorPass(array('required' => false)),
      'totbss'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ipk'                    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'skskum'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'telepon'                => new sfValidatorPass(array('required' => false)),
      'password'               => new sfValidatorPass(array('required' => false)),
      'angkatan'               => new sfValidatorPass(array('required' => false)),
      'namasma'                => new sfValidatorPass(array('required' => false)),
      'namaortu'               => new sfValidatorPass(array('required' => false)),
      'kelamin'                => new sfValidatorPass(array('required' => false)),
      'asisten'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'konsultasi'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'aa'                     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'transkrip_asli_list'    => new sfValidatorPropelChoice(array('model' => 'MataKuliah', 'required' => false)),
      'transkrip_list'         => new sfValidatorPropelChoice(array('model' => 'MataKuliah', 'required' => false)),
      'minat_mata_kuliah_list' => new sfValidatorPropelChoice(array('model' => 'MataKuliah', 'required' => false)),
      'daftar_kelas_list'      => new sfValidatorPropelChoice(array('model' => 'FPP', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mahasiswa_filters[%s]');

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

    $criteria->addJoin(TranskripAsliPeer::NRP, MahasiswaPeer::NRP);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(TranskripAsliPeer::KODE_MK, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(TranskripAsliPeer::KODE_MK, $value));
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

    $criteria->addJoin(TranskripPeer::NRP, MahasiswaPeer::NRP);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(TranskripPeer::KODE_MK, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(TranskripPeer::KODE_MK, $value));
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

    $criteria->addJoin(MinatMataKuliahPeer::NRP, MahasiswaPeer::NRP);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(MinatMataKuliahPeer::KODE_MK, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(MinatMataKuliahPeer::KODE_MK, $value));
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

    $criteria->addJoin(DaftarKelasPeer::NRP, MahasiswaPeer::NRP);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(DaftarKelasPeer::KODE_FPP, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(DaftarKelasPeer::KODE_FPP, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Mahasiswa';
  }

  public function getFields()
  {
    return array(
      'nrp'                    => 'Text',
      'sksmax'                 => 'Number',
      'ips'                    => 'Number',
      'status'                 => 'Text',
      'jurusan'                => 'Text',
      'nama'                   => 'Text',
      'alamat'                 => 'Text',
      'tgllahir'               => 'Date',
      'tmplahir'               => 'Text',
      'totbss'                 => 'Number',
      'ipk'                    => 'Number',
      'skskum'                 => 'Number',
      'telepon'                => 'Text',
      'password'               => 'Text',
      'angkatan'               => 'Text',
      'namasma'                => 'Text',
      'namaortu'               => 'Text',
      'kelamin'                => 'Text',
      'asisten'                => 'Boolean',
      'konsultasi'             => 'Boolean',
      'aa'                     => 'Boolean',
      'transkrip_asli_list'    => 'ManyKey',
      'transkrip_list'         => 'ManyKey',
      'minat_mata_kuliah_list' => 'ManyKey',
      'daftar_kelas_list'      => 'ManyKey',
    );
  }
}
