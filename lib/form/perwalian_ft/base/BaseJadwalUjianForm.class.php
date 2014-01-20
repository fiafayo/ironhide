<?php

/**
 * JadwalUjian form base class.
 *
 * @method JadwalUjian getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseJadwalUjianForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_ujian'          => new sfWidgetFormInputHidden(),
      'kode_mk'             => new sfWidgetFormPropelChoice(array('model' => 'MataKuliah', 'add_empty' => false)),
      'hari'                => new sfWidgetFormInputText(),
      'jam'                 => new sfWidgetFormInputText(),
      'minggu'              => new sfWidgetFormInputText(),
      'semester'            => new sfWidgetFormInputText(),
      'tahun'               => new sfWidgetFormInputText(),
      'jenis_ruang'         => new sfWidgetFormInputText(),
      'jumlah_mhs'          => new sfWidgetFormInputText(),
      'jenis_ujian'         => new sfWidgetFormInputText(),
      'ruang_block_list'    => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Ruang')),
      'karyawan_block_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Karyawan')),
      'dosen_block_list'    => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Dosen')),
    ));

    $this->setValidators(array(
      'kode_ujian'          => new sfValidatorPropelChoice(array('model' => 'JadwalUjian', 'column' => 'kode_ujian', 'required' => false)),
      'kode_mk'             => new sfValidatorPropelChoice(array('model' => 'MataKuliah', 'column' => 'kode_mk')),
      'hari'                => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'jam'                 => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'minggu'              => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'semester'            => new sfValidatorString(array('max_length' => 5)),
      'tahun'               => new sfValidatorString(array('max_length' => 9)),
      'jenis_ruang'         => new sfValidatorString(array('max_length' => 6)),
      'jumlah_mhs'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'jenis_ujian'         => new sfValidatorString(array('max_length' => 3)),
      'ruang_block_list'    => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Ruang', 'required' => false)),
      'karyawan_block_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Karyawan', 'required' => false)),
      'dosen_block_list'    => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Dosen', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('jadwal_ujian[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JadwalUjian';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['ruang_block_list']))
    {
      $values = array();
      foreach ($this->object->getRuangBlocks() as $obj)
      {
        $values[] = $obj->getKodeRuang();
      }

      $this->setDefault('ruang_block_list', $values);
    }

    if (isset($this->widgetSchema['karyawan_block_list']))
    {
      $values = array();
      foreach ($this->object->getKaryawanBlocks() as $obj)
      {
        $values[] = $obj->getKodeKaryawan();
      }

      $this->setDefault('karyawan_block_list', $values);
    }

    if (isset($this->widgetSchema['dosen_block_list']))
    {
      $values = array();
      foreach ($this->object->getDosenBlocks() as $obj)
      {
        $values[] = $obj->getKodeDosen();
      }

      $this->setDefault('dosen_block_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveRuangBlockList($con);
    $this->saveKaryawanBlockList($con);
    $this->saveDosenBlockList($con);
  }

  public function saveRuangBlockList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['ruang_block_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(RuangBlockPeer::KODE_UJIAN, $this->object->getPrimaryKey());
    RuangBlockPeer::doDelete($c, $con);

    $values = $this->getValue('ruang_block_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RuangBlock();
        $obj->setKodeUjian($this->object->getPrimaryKey());
        $obj->setKodeRuang($value);
        $obj->save();
      }
    }
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
    $c->add(KaryawanBlockPeer::KODE_UJIAN, $this->object->getPrimaryKey());
    KaryawanBlockPeer::doDelete($c, $con);

    $values = $this->getValue('karyawan_block_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new KaryawanBlock();
        $obj->setKodeUjian($this->object->getPrimaryKey());
        $obj->setKodeKaryawan($value);
        $obj->save();
      }
    }
  }

  public function saveDosenBlockList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['dosen_block_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(DosenBlockPeer::KODE_UJIAN, $this->object->getPrimaryKey());
    DosenBlockPeer::doDelete($c, $con);

    $values = $this->getValue('dosen_block_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new DosenBlock();
        $obj->setKodeUjian($this->object->getPrimaryKey());
        $obj->setKodeDosen($value);
        $obj->save();
      }
    }
  }

}
