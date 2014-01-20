<?php

/**
 * FPP filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFPPFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'jenis'             => new sfWidgetFormFilterInput(),
      'semester'          => new sfWidgetFormFilterInput(),
      'tahun'             => new sfWidgetFormFilterInput(),
      'waktu_buka'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'waktu_tutup'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'status_aktif'      => new sfWidgetFormFilterInput(),
      'daftar_kelas_list' => new sfWidgetFormPropelChoice(array('model' => 'KelasMK', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'jenis'             => new sfValidatorPass(array('required' => false)),
      'semester'          => new sfValidatorPass(array('required' => false)),
      'tahun'             => new sfValidatorPass(array('required' => false)),
      'waktu_buka'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'waktu_tutup'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'status_aktif'      => new sfValidatorPass(array('required' => false)),
      'daftar_kelas_list' => new sfValidatorPropelChoice(array('model' => 'KelasMK', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fpp_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
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

    $criteria->addJoin(DaftarKelasPeer::KODE_FPP, FPPPeer::KODE_FPP);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(DaftarKelasPeer::KODE_KELAS, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(DaftarKelasPeer::KODE_KELAS, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'FPP';
  }

  public function getFields()
  {
    return array(
      'kode_fpp'          => 'Text',
      'jenis'             => 'Text',
      'semester'          => 'Text',
      'tahun'             => 'Text',
      'waktu_buka'        => 'Date',
      'waktu_tutup'       => 'Date',
      'status_aktif'      => 'Text',
      'daftar_kelas_list' => 'ManyKey',
    );
  }
}
