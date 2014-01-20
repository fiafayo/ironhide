<?php

/**
 * MataKuliah form base class.
 *
 * @method MataKuliah getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMataKuliahForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_mk'                  => new sfWidgetFormInputHidden(),
      'nama'                     => new sfWidgetFormInputText(),
      'sks'                      => new sfWidgetFormInputText(),
      'transkrip_asli_list'      => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Mahasiswa')),
      'mata_kuliah_jurusan_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Jurusan')),
      'transkrip_list'           => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Mahasiswa')),
      'dosen_mata_kuliah_list'   => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Dosen')),
      'minat_mata_kuliah_list'   => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Mahasiswa')),
    ));

    $this->setValidators(array(
      'kode_mk'                  => new sfValidatorPropelChoice(array('model' => 'MataKuliah', 'column' => 'kode_mk', 'required' => false)),
      'nama'                     => new sfValidatorString(array('max_length' => 60)),
      'sks'                      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'transkrip_asli_list'      => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Mahasiswa', 'required' => false)),
      'mata_kuliah_jurusan_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Jurusan', 'required' => false)),
      'transkrip_list'           => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Mahasiswa', 'required' => false)),
      'dosen_mata_kuliah_list'   => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Dosen', 'required' => false)),
      'minat_mata_kuliah_list'   => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Mahasiswa', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mata_kuliah[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MataKuliah';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['transkrip_asli_list']))
    {
      $values = array();
      foreach ($this->object->getTranskripAslis() as $obj)
      {
        $values[] = $obj->getNrp();
      }

      $this->setDefault('transkrip_asli_list', $values);
    }

    if (isset($this->widgetSchema['mata_kuliah_jurusan_list']))
    {
      $values = array();
      foreach ($this->object->getMataKuliahJurusans() as $obj)
      {
        $values[] = $obj->getKodeJur();
      }

      $this->setDefault('mata_kuliah_jurusan_list', $values);
    }

    if (isset($this->widgetSchema['transkrip_list']))
    {
      $values = array();
      foreach ($this->object->getTranskrips() as $obj)
      {
        $values[] = $obj->getNrp();
      }

      $this->setDefault('transkrip_list', $values);
    }

    if (isset($this->widgetSchema['dosen_mata_kuliah_list']))
    {
      $values = array();
      foreach ($this->object->getDosenMataKuliahs() as $obj)
      {
        $values[] = $obj->getKodeDosen();
      }

      $this->setDefault('dosen_mata_kuliah_list', $values);
    }

    if (isset($this->widgetSchema['minat_mata_kuliah_list']))
    {
      $values = array();
      foreach ($this->object->getMinatMataKuliahs() as $obj)
      {
        $values[] = $obj->getNrp();
      }

      $this->setDefault('minat_mata_kuliah_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveTranskripAsliList($con);
    $this->saveMataKuliahJurusanList($con);
    $this->saveTranskripList($con);
    $this->saveDosenMataKuliahList($con);
    $this->saveMinatMataKuliahList($con);
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
    $c->add(TranskripAsliPeer::KODE_MK, $this->object->getPrimaryKey());
    TranskripAsliPeer::doDelete($c, $con);

    $values = $this->getValue('transkrip_asli_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new TranskripAsli();
        $obj->setKodeMk($this->object->getPrimaryKey());
        $obj->setNrp($value);
        $obj->save();
      }
    }
  }

  public function saveMataKuliahJurusanList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['mata_kuliah_jurusan_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(MataKuliahJurusanPeer::KODE_MK, $this->object->getPrimaryKey());
    MataKuliahJurusanPeer::doDelete($c, $con);

    $values = $this->getValue('mata_kuliah_jurusan_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new MataKuliahJurusan();
        $obj->setKodeMk($this->object->getPrimaryKey());
        $obj->setKodeJur($value);
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
    $c->add(TranskripPeer::KODE_MK, $this->object->getPrimaryKey());
    TranskripPeer::doDelete($c, $con);

    $values = $this->getValue('transkrip_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Transkrip();
        $obj->setKodeMk($this->object->getPrimaryKey());
        $obj->setNrp($value);
        $obj->save();
      }
    }
  }

  public function saveDosenMataKuliahList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['dosen_mata_kuliah_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(DosenMataKuliahPeer::KODE_MK, $this->object->getPrimaryKey());
    DosenMataKuliahPeer::doDelete($c, $con);

    $values = $this->getValue('dosen_mata_kuliah_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new DosenMataKuliah();
        $obj->setKodeMk($this->object->getPrimaryKey());
        $obj->setKodeDosen($value);
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
    $c->add(MinatMataKuliahPeer::KODE_MK, $this->object->getPrimaryKey());
    MinatMataKuliahPeer::doDelete($c, $con);

    $values = $this->getValue('minat_mata_kuliah_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new MinatMataKuliah();
        $obj->setKodeMk($this->object->getPrimaryKey());
        $obj->setNrp($value);
        $obj->save();
      }
    }
  }

}
