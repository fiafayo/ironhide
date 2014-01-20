<?php

/**
 * KelasMK form base class.
 *
 * @method KelasMK getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseKelasMKForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_kelas'         => new sfWidgetFormInputHidden(),
      'kode_mk'            => new sfWidgetFormPropelChoice(array('model' => 'MataKuliah', 'add_empty' => false)),
      'kp'                 => new sfWidgetFormInputText(),
      'isi'                => new sfWidgetFormInputText(),
      'kapasitas'          => new sfWidgetFormInputText(),
      'semester'           => new sfWidgetFormInputText(),
      'tahun'              => new sfWidgetFormInputText(),
      'status_buka'        => new sfWidgetFormInputCheckbox(),
      'dmb'                => new sfWidgetFormInputCheckbox(),
      'waktu_buka'         => new sfWidgetFormDateTime(),
      'dosen_kelas_list'   => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Dosen')),
      'daftar_kelas_list'  => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'FPP')),
      'kelas_jurusan_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Jurusan')),
    ));

    $this->setValidators(array(
      'kode_kelas'         => new sfValidatorPropelChoice(array('model' => 'KelasMK', 'column' => 'kode_kelas', 'required' => false)),
      'kode_mk'            => new sfValidatorPropelChoice(array('model' => 'MataKuliah', 'column' => 'kode_mk')),
      'kp'                 => new sfValidatorString(array('max_length' => 9)),
      'isi'                => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'kapasitas'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'semester'           => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'tahun'              => new sfValidatorString(array('max_length' => 9, 'required' => false)),
      'status_buka'        => new sfValidatorBoolean(array('required' => false)),
      'dmb'                => new sfValidatorBoolean(array('required' => false)),
      'waktu_buka'         => new sfValidatorDateTime(array('required' => false)),
      'dosen_kelas_list'   => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Dosen', 'required' => false)),
      'daftar_kelas_list'  => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'FPP', 'required' => false)),
      'kelas_jurusan_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Jurusan', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('kelas_mk[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'KelasMK';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['dosen_kelas_list']))
    {
      $values = array();
      foreach ($this->object->getDosenKelass() as $obj)
      {
        $values[] = $obj->getKodeDosen();
      }

      $this->setDefault('dosen_kelas_list', $values);
    }

    if (isset($this->widgetSchema['daftar_kelas_list']))
    {
      $values = array();
      foreach ($this->object->getDaftarKelass() as $obj)
      {
        $values[] = $obj->getKodeFpp();
      }

      $this->setDefault('daftar_kelas_list', $values);
    }

    if (isset($this->widgetSchema['kelas_jurusan_list']))
    {
      $values = array();
      foreach ($this->object->getKelasJurusans() as $obj)
      {
        $values[] = $obj->getKodeJur();
      }

      $this->setDefault('kelas_jurusan_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveDosenKelasList($con);
    $this->saveDaftarKelasList($con);
    $this->saveKelasJurusanList($con);
  }

  public function saveDosenKelasList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['dosen_kelas_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(DosenKelasPeer::KODE_KELAS, $this->object->getPrimaryKey());
    DosenKelasPeer::doDelete($c, $con);

    $values = $this->getValue('dosen_kelas_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new DosenKelas();
        $obj->setKodeKelas($this->object->getPrimaryKey());
        $obj->setKodeDosen($value);
        $obj->save();
      }
    }
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
    $c->add(DaftarKelasPeer::KODE_KELAS, $this->object->getPrimaryKey());
    DaftarKelasPeer::doDelete($c, $con);

    $values = $this->getValue('daftar_kelas_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new DaftarKelas();
        $obj->setKodeKelas($this->object->getPrimaryKey());
        $obj->setKodeFpp($value);
        $obj->save();
      }
    }
  }

  public function saveKelasJurusanList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['kelas_jurusan_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(KelasJurusanPeer::KODE_KELAS, $this->object->getPrimaryKey());
    KelasJurusanPeer::doDelete($c, $con);

    $values = $this->getValue('kelas_jurusan_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new KelasJurusan();
        $obj->setKodeKelas($this->object->getPrimaryKey());
        $obj->setKodeJur($value);
        $obj->save();
      }
    }
  }

}
