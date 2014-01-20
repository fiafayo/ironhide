<?php

/**
 * TranskripAsli filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTranskripAsliFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nilai'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nilai'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('transkrip_asli_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TranskripAsli';
  }

  public function getFields()
  {
    return array(
      'nrp'      => 'ForeignKey',
      'kode_mk'  => 'ForeignKey',
      'semester' => 'Text',
      'tahun'    => 'Text',
      'nilai'    => 'Text',
    );
  }
}
