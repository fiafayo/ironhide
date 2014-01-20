<?php

/**
 * DaftarKelas filter form base class.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDaftarKelasFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'status'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'status'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('daftar_kelas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DaftarKelas';
  }

  public function getFields()
  {
    return array(
      'kode_fpp'   => 'ForeignKey',
      'kode_kelas' => 'ForeignKey',
      'nrp'        => 'ForeignKey',
      'status'     => 'Text',
    );
  }
}
