<?php

/**
 * User filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'peran_user_id'    => new sfWidgetFormPropelChoice(array('model' => 'PeranUser', 'add_empty' => true)),
      'instansi_id'      => new sfWidgetFormPropelChoice(array('model' => 'Instansi', 'add_empty' => true)),
      'satuan_kerja_id'  => new sfWidgetFormPropelChoice(array('model' => 'SatuanKerja', 'add_empty' => true)),
      'username'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nama'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'default_password' => new sfWidgetFormFilterInput(),
      'password'         => new sfWidgetFormFilterInput(),
      'telepon'          => new sfWidgetFormFilterInput(),
      'alamat'           => new sfWidgetFormFilterInput(),
      'email'            => new sfWidgetFormFilterInput(),
      'public_key'       => new sfWidgetFormFilterInput(),
      'disabled'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'alasan_disabled'  => new sfWidgetFormFilterInput(),
      'state'            => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'peran_user_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'PeranUser', 'column' => 'id')),
      'instansi_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Instansi', 'column' => 'id')),
      'satuan_kerja_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SatuanKerja', 'column' => 'id')),
      'username'         => new sfValidatorPass(array('required' => false)),
      'nama'             => new sfValidatorPass(array('required' => false)),
      'default_password' => new sfValidatorPass(array('required' => false)),
      'password'         => new sfValidatorPass(array('required' => false)),
      'telepon'          => new sfValidatorPass(array('required' => false)),
      'alamat'           => new sfValidatorPass(array('required' => false)),
      'email'            => new sfValidatorPass(array('required' => false)),
      'public_key'       => new sfValidatorPass(array('required' => false)),
      'disabled'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'alasan_disabled'  => new sfValidatorPass(array('required' => false)),
      'state'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'peran_user_id'    => 'ForeignKey',
      'instansi_id'      => 'ForeignKey',
      'satuan_kerja_id'  => 'ForeignKey',
      'username'         => 'Text',
      'nama'             => 'Text',
      'default_password' => 'Text',
      'password'         => 'Text',
      'telepon'          => 'Text',
      'alamat'           => 'Text',
      'email'            => 'Text',
      'public_key'       => 'Text',
      'disabled'         => 'Boolean',
      'alasan_disabled'  => 'Text',
      'state'            => 'Number',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
