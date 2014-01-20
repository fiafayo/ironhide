<?php

/**
 * PeranUser filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePeranUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nama'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'credential'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'state'               => new sfWidgetFormFilterInput(),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'informasi_user_list' => new sfWidgetFormPropelChoice(array('model' => 'Informasi', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nama'                => new sfValidatorPass(array('required' => false)),
      'credential'          => new sfValidatorPass(array('required' => false)),
      'state'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'informasi_user_list' => new sfValidatorPropelChoice(array('model' => 'Informasi', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('peran_user_filters[%s]');

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

    $criteria->addJoin(InformasiUserPeer::USER_ID, PeranUserPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(InformasiUserPeer::INFORMASI_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(InformasiUserPeer::INFORMASI_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'PeranUser';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'nama'                => 'Text',
      'credential'          => 'Text',
      'state'               => 'Number',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'informasi_user_list' => 'ManyKey',
    );
  }
}
