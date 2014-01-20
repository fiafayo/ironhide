<?php

/**
 * Dosen form base class.
 *
 * @method Dosen getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDosenForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_dosen'             => new sfWidgetFormInputHidden(),
      'nama'                   => new sfWidgetFormInputText(),
      'status'                 => new sfWidgetFormInputText(),
      'kode_jur'               => new sfWidgetFormPropelChoice(array('model' => 'Jurusan', 'add_empty' => true)),
      'is_pengawas'            => new sfWidgetFormInputCheckbox(),
      'npk'                    => new sfWidgetFormInputText(),
      'dosen_mata_kuliah_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'MataKuliah')),
      'dosen_kelas_list'       => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'KelasMK')),
      'dosen_block_list'       => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'JadwalUjian')),
    ));

    $this->setValidators(array(
      'kode_dosen'             => new sfValidatorPropelChoice(array('model' => 'Dosen', 'column' => 'kode_dosen', 'required' => false)),
      'nama'                   => new sfValidatorString(array('max_length' => 20)),
      'status'                 => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'kode_jur'               => new sfValidatorPropelChoice(array('model' => 'Jurusan', 'column' => 'kode_jur', 'required' => false)),
      'is_pengawas'            => new sfValidatorBoolean(array('required' => false)),
      'npk'                    => new sfValidatorString(array('max_length' => 8)),
      'dosen_mata_kuliah_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'MataKuliah', 'required' => false)),
      'dosen_kelas_list'       => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'KelasMK', 'required' => false)),
      'dosen_block_list'       => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'JadwalUjian', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dosen[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Dosen';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['dosen_mata_kuliah_list']))
    {
      $values = array();
      foreach ($this->object->getDosenMataKuliahs() as $obj)
      {
        $values[] = $obj->getKodeMk();
      }

      $this->setDefault('dosen_mata_kuliah_list', $values);
    }

    if (isset($this->widgetSchema['dosen_kelas_list']))
    {
      $values = array();
      foreach ($this->object->getDosenKelass() as $obj)
      {
        $values[] = $obj->getKodeKelas();
      }

      $this->setDefault('dosen_kelas_list', $values);
    }

    if (isset($this->widgetSchema['dosen_block_list']))
    {
      $values = array();
      foreach ($this->object->getDosenBlocks() as $obj)
      {
        $values[] = $obj->getKodeUjian();
      }

      $this->setDefault('dosen_block_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveDosenMataKuliahList($con);
    $this->saveDosenKelasList($con);
    $this->saveDosenBlockList($con);
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
    $c->add(DosenMataKuliahPeer::KODE_DOSEN, $this->object->getPrimaryKey());
    DosenMataKuliahPeer::doDelete($c, $con);

    $values = $this->getValue('dosen_mata_kuliah_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new DosenMataKuliah();
        $obj->setKodeDosen($this->object->getPrimaryKey());
        $obj->setKodeMk($value);
        $obj->save();
      }
    }
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
    $c->add(DosenKelasPeer::KODE_DOSEN, $this->object->getPrimaryKey());
    DosenKelasPeer::doDelete($c, $con);

    $values = $this->getValue('dosen_kelas_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new DosenKelas();
        $obj->setKodeDosen($this->object->getPrimaryKey());
        $obj->setKodeKelas($value);
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
    $c->add(DosenBlockPeer::KODE_DOSEN, $this->object->getPrimaryKey());
    DosenBlockPeer::doDelete($c, $con);

    $values = $this->getValue('dosen_block_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new DosenBlock();
        $obj->setKodeDosen($this->object->getPrimaryKey());
        $obj->setKodeUjian($value);
        $obj->save();
      }
    }
  }

}
