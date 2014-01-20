<?php

/**
 * KelasJurusan form base class.
 *
 * @method KelasJurusan getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseKelasJurusanForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_kelas' => new sfWidgetFormInputHidden(),
      'kode_jur'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'kode_kelas' => new sfValidatorPropelChoice(array('model' => 'KelasMK', 'column' => 'kode_kelas', 'required' => false)),
      'kode_jur'   => new sfValidatorPropelChoice(array('model' => 'Jurusan', 'column' => 'kode_jur', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('kelas_jurusan[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'KelasJurusan';
  }


}
