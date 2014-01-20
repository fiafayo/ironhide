<?php

/**
 * RuangBlock form base class.
 *
 * @method RuangBlock getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRuangBlockForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_ruang' => new sfWidgetFormInputHidden(),
      'kode_ujian' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'kode_ruang' => new sfValidatorPropelChoice(array('model' => 'Ruang', 'column' => 'kode_ruang', 'required' => false)),
      'kode_ujian' => new sfValidatorPropelChoice(array('model' => 'JadwalUjian', 'column' => 'kode_ujian', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ruang_block[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RuangBlock';
  }


}
