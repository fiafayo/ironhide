<?php

/**
 * TranskripAsli form base class.
 *
 * @method TranskripAsli getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTranskripAsliForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nrp'      => new sfWidgetFormInputHidden(),
      'kode_mk'  => new sfWidgetFormInputHidden(),
      'semester' => new sfWidgetFormInputHidden(),
      'tahun'    => new sfWidgetFormInputHidden(),
      'nilai'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'nrp'      => new sfValidatorPropelChoice(array('model' => 'Mahasiswa', 'column' => 'nrp', 'required' => false)),
      'kode_mk'  => new sfValidatorPropelChoice(array('model' => 'MataKuliah', 'column' => 'kode_mk', 'required' => false)),
      'semester' => new sfValidatorPropelChoice(array('model' => 'TranskripAsli', 'column' => 'semester', 'required' => false)),
      'tahun'    => new sfValidatorPropelChoice(array('model' => 'TranskripAsli', 'column' => 'tahun', 'required' => false)),
      'nilai'    => new sfValidatorString(array('max_length' => 3, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('transkrip_asli[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TranskripAsli';
  }


}
