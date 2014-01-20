<?php

/**
 * Jurusan form base class.
 *
 * @method Jurusan getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseJurusanForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_jur'                 => new sfWidgetFormInputHidden(),
      'nama'                     => new sfWidgetFormInputText(),
      'mata_kuliah_jurusan_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'MataKuliah')),
      'kelas_jurusan_list'       => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'KelasMK')),
    ));

    $this->setValidators(array(
      'kode_jur'                 => new sfValidatorPropelChoice(array('model' => 'Jurusan', 'column' => 'kode_jur', 'required' => false)),
      'nama'                     => new sfValidatorString(array('max_length' => 120)),
      'mata_kuliah_jurusan_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'MataKuliah', 'required' => false)),
      'kelas_jurusan_list'       => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'KelasMK', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('jurusan[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Jurusan';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['mata_kuliah_jurusan_list']))
    {
      $values = array();
      foreach ($this->object->getMataKuliahJurusans() as $obj)
      {
        $values[] = $obj->getKodeMk();
      }

      $this->setDefault('mata_kuliah_jurusan_list', $values);
    }

    if (isset($this->widgetSchema['kelas_jurusan_list']))
    {
      $values = array();
      foreach ($this->object->getKelasJurusans() as $obj)
      {
        $values[] = $obj->getKodeKelas();
      }

      $this->setDefault('kelas_jurusan_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveMataKuliahJurusanList($con);
    $this->saveKelasJurusanList($con);
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
    $c->add(MataKuliahJurusanPeer::KODE_JUR, $this->object->getPrimaryKey());
    MataKuliahJurusanPeer::doDelete($c, $con);

    $values = $this->getValue('mata_kuliah_jurusan_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new MataKuliahJurusan();
        $obj->setKodeJur($this->object->getPrimaryKey());
        $obj->setKodeMk($value);
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
    $c->add(KelasJurusanPeer::KODE_JUR, $this->object->getPrimaryKey());
    KelasJurusanPeer::doDelete($c, $con);

    $values = $this->getValue('kelas_jurusan_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new KelasJurusan();
        $obj->setKodeJur($this->object->getPrimaryKey());
        $obj->setKodeKelas($value);
        $obj->save();
      }
    }
  }

}
