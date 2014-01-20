<?php

/**
 * PeranUser form base class.
 *
 * @method PeranUser getObject() Returns the current form's model object
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePeranUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'nama'                => new sfWidgetFormInputText(),
      'credential'          => new sfWidgetFormInputText(),
      'state'               => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'informasi_user_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Informasi')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorPropelChoice(array('model' => 'PeranUser', 'column' => 'id', 'required' => false)),
      'nama'                => new sfValidatorString(array('max_length' => 255)),
      'credential'          => new sfValidatorString(array('max_length' => 255)),
      'state'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
      'updated_at'          => new sfValidatorDateTime(array('required' => false)),
      'informasi_user_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Informasi', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('peran_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PeranUser';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['informasi_user_list']))
    {
      $values = array();
      foreach ($this->object->getInformasiUsers() as $obj)
      {
        $values[] = $obj->getInformasiId();
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
    $c->add(InformasiUserPeer::USER_ID, $this->object->getPrimaryKey());
    InformasiUserPeer::doDelete($c, $con);

    $values = $this->getValue('informasi_user_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new InformasiUser();
        $obj->setUserId($this->object->getPrimaryKey());
        $obj->setInformasiId($value);
        $obj->save();
      }
    }
  }

}
