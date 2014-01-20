<?php

/**
 * Admin filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAdminFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nama'     => new sfWidgetFormFilterInput(),
      'kode_jur' => new sfWidgetFormPropelChoice(array('model' => 'Jurusan', 'add_empty' => true)),
      'password' => new sfWidgetFormFilterInput(),
      'jabatan'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nama'     => new sfValidatorPass(array('required' => false)),
      'kode_jur' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Jurusan', 'column' => 'kode_jur')),
      'password' => new sfValidatorPass(array('required' => false)),
      'jabatan'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('admin_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Admin';
  }

  public function getFields()
  {
    return array(
      'nik'      => 'Text',
      'nama'     => 'Text',
      'kode_jur' => 'ForeignKey',
      'password' => 'Text',
      'jabatan'  => 'Text',
    );
  }
}
