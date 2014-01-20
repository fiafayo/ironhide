<?php

/**
 * Ruang form base class.
 *
 * @method Ruang getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRuangForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'kode_ruang'       => new sfWidgetFormInputHidden(),
      'kapasitas'        => new sfWidgetFormInputText(),
      'jenis'            => new sfWidgetFormInputText(),
      'kapasitas_ujian'  => new sfWidgetFormInputText(),
      'prioritas'        => new sfWidgetFormInputText(),
      'untuk_ujian'      => new sfWidgetFormInputCheckbox(),
      'ruang_block_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'JadwalUjian')),
    ));

    $this->setValidators(array(
      'kode_ruang'       => new sfValidatorPropelChoice(array('model' => 'Ruang', 'column' => 'kode_ruang', 'required' => false)),
      'kapasitas'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'jenis'            => new sfValidatorString(array('max_length' => 20)),
      'kapasitas_ujian'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'prioritas'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'untuk_ujian'      => new sfValidatorBoolean(),
      'ruang_block_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'JadwalUjian', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ruang[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ruang';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['ruang_block_list']))
    {
      $values = array();
      foreach ($this->object->getRuangBlocks() as $obj)
      {
        $values[] = $obj->getKodeUjian();
      }

      $this->setDefault('ruang_block_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveRuangBlockList($con);
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
    $c->add(RuangBlockPeer::KODE_RUANG, $this->object->getPrimaryKey());
    RuangBlockPeer::doDelete($c, $con);

    $values = $this->getValue('ruang_block_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RuangBlock();
        $obj->setKodeRuang($this->object->getPrimaryKey());
        $obj->setKodeUjian($value);
        $obj->save();
      }
    }
  }

}
