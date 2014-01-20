<?php

/**
 * MinatMataKuliah filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMinatMataKuliahFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'angkatan' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'angkatan' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('minat_mata_kuliah_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MinatMataKuliah';
  }

  public function getFields()
  {
    return array(
      'nrp'      => 'ForeignKey',
      'kode_mk'  => 'ForeignKey',
      'angkatan' => 'Number',
    );
  }
}
