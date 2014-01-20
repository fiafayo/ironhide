<?php

/**
 * Karyawan form base class.
 *
 * @method Karyawan getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseKaryawanForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_karyawan'       => new sfWidgetFormInputHidden(),
      'nama'                => new sfWidgetFormInputText(),
      'kode_jur'            => new sfWidgetFormPropelChoice(array('model' => 'Jurusan', 'add_empty' => true)),
      'is_pengawas'         => new sfWidgetFormInputCheckbox(),
      'karyawan_block_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'JadwalUjian')),
    ));

    $this->setValidators(array(
      'kode_karyawan'       => new sfValidatorPropelChoice(array('model' => 'Karyawan', 'column' => 'kode_karyawan', 'required' => false)),
      'nama'                => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'kode_jur'            => new sfValidatorPropelChoice(array('model' => 'Jurusan', 'column' => 'kode_jur', 'required' => false)),
      'is_pengawas'         => new sfValidatorBoolean(array('required' => false)),
      'karyawan_block_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'JadwalUjian', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('karyawan[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Karyawan';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['karyawan_block_list']))
    {
      $values = array();
      foreach ($this->object->getKaryawanBlocks() as $obj)
      {
        $values[] = $obj->getKodeUjian();
      }

      $this->setDefault('karyawan_block_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveKaryawanBlockList($con);
  }

  public function saveKaryawanBlockList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['karyawan_block_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(KaryawanBlockPeer::KODE_KARYAWAN, $this->object->getPrimaryKey());
    KaryawanBlockPeer::doDelete($c, $con);

    $values = $this->getValue('karyawan_block_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new KaryawanBlock();
        $obj->setKodeKaryawan($this->object->getPrimaryKey());
        $obj->setKodeUjian($value);
        $obj->save();
      }
    }
  }

}
