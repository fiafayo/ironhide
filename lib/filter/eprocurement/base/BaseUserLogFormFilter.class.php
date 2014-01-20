<?php

/**
 * UserLog filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseUserLogFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'action'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'subject'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'address'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description' => new sfWidgetFormFilterInput(),
      'kode_fpp'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'kode_kelas'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nrp'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'username'    => new sfValidatorPass(array('required' => false)),
      'action'      => new sfValidatorPass(array('required' => false)),
      'subject'     => new sfValidatorPass(array('required' => false)),
      'address'     => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'kode_fpp'    => new sfValidatorPass(array('required' => false)),
      'kode_kelas'  => new sfValidatorPass(array('required' => false)),
      'nrp'         => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('user_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserLog';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'username'    => 'Text',
      'action'      => 'Text',
      'subject'     => 'Text',
      'address'     => 'Text',
      'description' => 'Text',
      'kode_fpp'    => 'Text',
      'kode_kelas'  => 'Text',
      'nrp'         => 'Text',
      'created_at'  => 'Date',
    );
  }
}
