<?php

/**
 * BaakMahasiswa form base class.
 *
 * @method BaakMahasiswa getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBaakMahasiswaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'NRP'          => new sfWidgetFormInputHidden(),
      'Pin'          => new sfWidgetFormInputText(),
      'Nama'         => new sfWidgetFormInputText(),
      'KodeStatus'   => new sfWidgetFormInputText(),
      'IPKDenganE'   => new sfWidgetFormInputText(),
      'IPKTanpaE'    => new sfWidgetFormInputText(),
      'IPSAkhir'     => new sfWidgetFormInputText(),
      'SksMaxDepan'  => new sfWidgetFormInputText(),
      'SKSKumTanpaE' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'NRP'          => new sfValidatorPropelChoice(array('model' => 'BaakMahasiswa', 'column' => 'NRP', 'required' => false)),
      'Pin'          => new sfValidatorString(array('max_length' => 125)),
      'Nama'         => new sfValidatorString(array('max_length' => 40)),
      'KodeStatus'   => new sfValidatorString(array('max_length' => 3)),
      'IPKDenganE'   => new sfValidatorNumber(),
      'IPKTanpaE'    => new sfValidatorNumber(),
      'IPSAkhir'     => new sfValidatorNumber(),
      'SksMaxDepan'  => new sfValidatorInteger(array('min' => -32768, 'max' => 32767)),
      'SKSKumTanpaE' => new sfValidatorInteger(array('min' => -32768, 'max' => 32767)),
    ));

    $this->widgetSchema->setNameFormat('baak_mahasiswa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BaakMahasiswa';
  }


}
