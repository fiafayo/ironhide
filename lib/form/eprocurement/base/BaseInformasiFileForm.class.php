<?php

/**
 * InformasiFile form base class.
 *
 * @method InformasiFile getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInformasiFileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'informasi_id' => new sfWidgetFormPropelChoice(array('model' => 'Informasi', 'add_empty' => false)),
      'file_name'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'InformasiFile', 'column' => 'id', 'required' => false)),
      'informasi_id' => new sfValidatorPropelChoice(array('model' => 'Informasi', 'column' => 'id')),
      'file_name'    => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('informasi_file[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InformasiFile';
  }


}
