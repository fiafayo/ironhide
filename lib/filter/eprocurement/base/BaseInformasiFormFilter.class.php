<?php

/**
 * Informasi filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInformasiFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'judul'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tanggal'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'penulis'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'isi'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'jenis'               => new sfWidgetFormFilterInput(),
      'umum'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'instansi_id'         => new sfWidgetFormPropelChoice(array('model' => 'Instansi', 'add_empty' => true)),
      'state'               => new sfWidgetFormFilterInput(),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'informasi_user_list' => new sfWidgetFormPropelChoice(array('model' => 'PeranUser', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'judul'               => new sfValidatorPass(array('required' => false)),
      'tanggal'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'penulis'             => new sfValidatorPass(array('required' => false)),
      'isi'                 => new sfValidatorPass(array('required' => false)),
      'jenis'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'umum'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'instansi_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Instansi', 'column' => 'id')),
      'state'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'informasi_user_list' => new sfValidatorPropelChoice(array('model' => 'PeranUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('informasi_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addInformasiUserListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(InformasiUserPeer::INFORMASI_ID, InformasiPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(InformasiUserPeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(InformasiUserPeer::USER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Informasi';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'judul'               => 'Text',
      'tanggal'             => 'Date',
      'penulis'             => 'Text',
      'isi'                 => 'Text',
      'jenis'               => 'Number',
      'umum'                => 'Boolean',
      'instansi_id'         => 'ForeignKey',
      'state'               => 'Number',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'informasi_user_list' => 'ManyKey',
    );
  }
}
