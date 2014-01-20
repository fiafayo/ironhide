<?php

/**
 * FPP form base class.
 *
 * @method FPP getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFPPForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_fpp'          => new sfWidgetFormInputHidden(),
      'jenis'             => new sfWidgetFormInputText(),
      'semester'          => new sfWidgetFormInputText(),
      'tahun'             => new sfWidgetFormInputText(),
      'waktu_buka'        => new sfWidgetFormDateTime(),
      'waktu_tutup'       => new sfWidgetFormDateTime(),
      'status_aktif'      => new sfWidgetFormInputText(),
      'daftar_kelas_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'KelasMK')),
    ));

    $this->setValidators(array(
      'kode_fpp'          => new sfValidatorPropelChoice(array('model' => 'FPP', 'column' => 'kode_fpp', 'required' => false)),
      'jenis'             => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'semester'          => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'tahun'             => new sfValidatorString(array('max_length' => 9, 'required' => false)),
      'waktu_buka'        => new sfValidatorDateTime(array('required' => false)),
      'waktu_tutup'       => new sfValidatorDateTime(array('required' => false)),
      'status_aktif'      => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'daftar_kelas_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'KelasMK', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fpp[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FPP';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['daftar_kelas_list']))
    {
      $values = array();
      foreach ($this->object->getDaftarKelass() as $obj)
      {
        $values[] = $obj->getKodeKelas();
      }

      $this->setDefault('daftar_kelas_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveDaftarKelasList($con);
  }

  public function saveDaftarKelasList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['daftar_kelas_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(DaftarKelasPeer::KODE_FPP, $this->object->getPrimaryKey());
    DaftarKelasPeer::doDelete($c, $con);

    $values = $this->getValue('daftar_kelas_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new DaftarKelas();
        $obj->setKodeFpp($this->object->getPrimaryKey());
        $obj->setKodeKelas($value);
        $obj->save();
      }
    }
  }

}
