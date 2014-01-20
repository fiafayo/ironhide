<?php

/**
 * InformasiFile filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInformasiFileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'informasi_id' => new sfWidgetFormPropelChoice(array('model' => 'Informasi', 'add_empty' => true)),
      'file_name'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'informasi_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Informasi', 'column' => 'id')),
      'file_name'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('informasi_file_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InformasiFile';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'informasi_id' => 'ForeignKey',
      'file_name'    => 'Text',
    );
  }
}
