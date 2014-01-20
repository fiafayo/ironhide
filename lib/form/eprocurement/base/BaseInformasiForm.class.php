<?php

/**
 * Informasi form base class.
 *
 * @method Informasi getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseInformasiForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'judul'               => new sfWidgetFormTextarea(),
      'tanggal'             => new sfWidgetFormDate(),
      'penulis'             => new sfWidgetFormTextarea(),
      'isi'                 => new sfWidgetFormTextarea(),
      'jenis'               => new sfWidgetFormInputText(),
      'umum'                => new sfWidgetFormInputCheckbox(),
      'instansi_id'         => new sfWidgetFormPropelChoice(array('model' => 'Instansi', 'add_empty' => false)),
      'state'               => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'informasi_user_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'PeranUser')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorPropelChoice(array('model' => 'Informasi', 'column' => 'id', 'required' => false)),
      'judul'               => new sfValidatorString(),
      'tanggal'             => new sfValidatorDate(array('required' => false)),
      'penulis'             => new sfValidatorString(),
      'isi'                 => new sfValidatorString(),
      'jenis'               => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
      'umum'                => new sfValidatorBoolean(array('required' => false)),
      'instansi_id'         => new sfValidatorPropelChoice(array('model' => 'Instansi', 'column' => 'id')),
      'state'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
      'updated_at'          => new sfValidatorDateTime(array('required' => false)),
      'informasi_user_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'PeranUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('informasi[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Informasi';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['informasi_user_list']))
    {
      $values = array();
      foreach ($this->object->getInformasiUsers() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('informasi_user_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveInformasiUserList($con);
  }

  public function saveInformasiUserList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['informasi_user_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(InformasiUserPeer::INFORMASI_ID, $this->object->getPrimaryKey());
    InformasiUserPeer::doDelete($c, $con);

    $values = $this->getValue('informasi_user_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new InformasiUser();
        $obj->setInformasiId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

}
