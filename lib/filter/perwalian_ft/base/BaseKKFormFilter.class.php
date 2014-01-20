<?php

/**
 * KK filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseKKFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'jwd_kul'   => new sfWidgetFormFilterInput(),
      'jwd_ujian' => new sfWidgetFormFilterInput(),
      'mk_p'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'jwd_kul'   => new sfValidatorPass(array('required' => false)),
      'jwd_ujian' => new sfValidatorPass(array('required' => false)),
      'mk_p'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('kk_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'KK';
  }

  public function getFields()
  {
    return array(
      'kode_fpp'  => 'Text',
      'jwd_kul'   => 'Text',
      'jwd_ujian' => 'Text',
      'mk_p'      => 'Text',
    );
  }
}
