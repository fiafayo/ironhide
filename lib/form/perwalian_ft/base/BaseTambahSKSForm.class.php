<?php

/**
 * TambahSKS form base class.
 *
 * @method TambahSKS getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTambahSKSForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'nrp'        => new sfWidgetFormPropelChoice(array('model' => 'Mahasiswa', 'add_empty' => true)),
      'jml_sks'    => new sfWidgetFormInputText(),
      'keterangan' => new sfWidgetFormTextarea(),
      'semester'   => new sfWidgetFormInputText(),
      'tahun'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'TambahSKS', 'column' => 'id', 'required' => false)),
      'nrp'        => new sfValidatorPropelChoice(array('model' => 'Mahasiswa', 'column' => 'nrp', 'required' => false)),
      'jml_sks'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'keterangan' => new sfValidatorString(array('required' => false)),
      'semester'   => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'tahun'      => new sfValidatorString(array('max_length' => 9, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tambah_sks[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TambahSKS';
  }


}
