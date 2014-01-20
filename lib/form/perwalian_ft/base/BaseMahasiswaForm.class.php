<?php

/**
 * Mahasiswa form base class.
 *
 * @method Mahasiswa getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMahasiswaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nrp'                    => new sfWidgetFormInputHidden(),
      'sksmax'                 => new sfWidgetFormInputText(),
      'ips'                    => new sfWidgetFormInputText(),
      'status'                 => new sfWidgetFormInputText(),
      'jurusan'                => new sfWidgetFormInputText(),
      'nama'                   => new sfWidgetFormInputText(),
      'alamat'                 => new sfWidgetFormInputText(),
      'tgllahir'               => new sfWidgetFormDate(),
      'tmplahir'               => new sfWidgetFormInputText(),
      'totbss'                 => new sfWidgetFormInputText(),
      'ipk'                    => new sfWidgetFormInputText(),
      'skskum'                 => new sfWidgetFormInputText(),
      'telepon'                => new sfWidgetFormInputText(),
      'password'               => new sfWidgetFormInputText(),
      'angkatan'               => new sfWidgetFormInputText(),
      'namasma'                => new sfWidgetFormInputText(),
      'namaortu'               => new sfWidgetFormInputText(),
      'kelamin'                => new sfWidgetFormInputText(),
      'asisten'                => new sfWidgetFormInputCheckbox(),
      'konsultasi'             => new sfWidgetFormInputCheckbox(),
      'aa'                     => new sfWidgetFormInputCheckbox(),
      'transkrip_asli_list'    => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'MataKuliah')),
      'transkrip_list'         => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'MataKuliah')),
      'minat_mata_kuliah_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'MataKuliah')),
      'daftar_kelas_list'      => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'FPP')),
    ));

    $this->setValidators(array(
      'nrp'                    => new sfValidatorPropelChoice(array('model' => 'Mahasiswa', 'column' => 'nrp', 'required' => false)),
      'sksmax'                 => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'ips'                    => new sfValidatorNumber(array('required' => false)),
      'status'                 => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'jurusan'                => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'nama'                   => new sfValidatorString(array('max_length' => 60)),
      'alamat'                 => new sfValidatorString(array('max_length' => 60)),
      'tgllahir'               => new sfValidatorDate(array('required' => false)),
      'tmplahir'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'totbss'                 => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'ipk'                    => new sfValidatorNumber(array('required' => false)),
      'skskum'                 => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'telepon'                => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'password'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'angkatan'               => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'namasma'                => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'namaortu'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'kelamin'                => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'asisten'                => new sfValidatorBoolean(array('required' => false)),
      'konsultasi'             => new sfValidatorBoolean(array('required' => false)),
      'aa'                     => new sfValidatorBoolean(array('required' => false)),
      'transkrip_asli_list'    => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'MataKuliah', 'required' => false)),
      'transkrip_list'         => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'MataKuliah', 'required' => false)),
      'minat_mata_kuliah_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'MataKuliah', 'required' => false)),
      'daftar_kelas_list'      => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'FPP', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mahasiswa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mahasiswa';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['transkrip_asli_list']))
    {
      $values = array();
      foreach ($this->object->getTranskripAslis() as $obj)
      {
        $values[] = $obj->getKodeMk();
      }

      $this->setDefault('transkrip_asli_list', $values);
    }

    if (isset($this->widgetSchema['transkrip_list']))
    {
      $values = array();
      foreach ($this->object->getTranskrips() as $obj)
      {
        $values[] = $obj->getKodeMk();
      }

      $this->setDefault('transkrip_list', $values);
    }

    if (isset($this->widgetSchema['minat_mata_kuliah_list']))
    {
      $values = array();
      foreach ($this->object->getMinatMataKuliahs() as $obj)
      {
        $values[] = $obj->getKodeMk();
      }

      $this->setDefault('minat_mata_kuliah_list', $values);
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

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveTranskripAsliList($con);
    $this->saveTranskripList($con);
    $this->saveMinatMataKuliahList($con);
    $this->saveDaftarKelasList($con);
  }

  public function saveTranskripAsliList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['transkrip_asli_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(TranskripAsliPeer::NRP, $this->object->getPrimaryKey());
    TranskripAsliPeer::doDelete($c, $con);

    $values = $this->getValue('transkrip_asli_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new TranskripAsli();
        $obj->setNrp($this->object->getPrimaryKey());
        $obj->setKodeMk($value);
        $obj->save();
      }
    }
  }

  public function saveTranskripList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['transkrip_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(TranskripPeer::NRP, $this->object->getPrimaryKey());
    TranskripPeer::doDelete($c, $con);

    $values = $this->getValue('transkrip_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Transkrip();
        $obj->setNrp($this->object->getPrimaryKey());
        $obj->setKodeMk($value);
        $obj->save();
      }
    }
  }

  public function saveMinatMataKuliahList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['minat_mata_kuliah_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(MinatMataKuliahPeer::NRP, $this->object->getPrimaryKey());
    MinatMataKuliahPeer::doDelete($c, $con);

    $values = $this->getValue('minat_mata_kuliah_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new MinatMataKuliah();
        $obj->setNrp($this->object->getPrimaryKey());
        $obj->setKodeMk($value);
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
    $c->add(DaftarKelasPeer::NRP, $this->object->getPrimaryKey());
    DaftarKelasPeer::doDelete($c, $con);

    $values = $this->getValue('daftar_kelas_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new DaftarKelas();
        $obj->setNrp($this->object->getPrimaryKey());
        $obj->setKodeFpp($value);
        $obj->save();
      }
    }
  }

}
