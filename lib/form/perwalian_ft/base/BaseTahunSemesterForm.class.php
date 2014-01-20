<?php

/**
 * TahunSemester form base class.
 *
 * @method TahunSemester getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTahunSemesterForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode'     => new sfWidgetFormInputHidden(),
      'semester' => new sfWidgetFormInputText(),
      'tahun'    => new sfWidgetFormInputText(),
      'is_aktif' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'kode'     => new sfValidatorPropelChoice(array('model' => 'TahunSemester', 'column' => 'kode', 'required' => false)),
      'semester' => new sfValidatorString(array('max_length' => 5)),
      'tahun'    => new sfValidatorString(array('max_length' => 9)),
      'is_aktif' => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('tahun_semester[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TahunSemester';
  }


}
