<?php

/**
 * Karyawan form.
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class KaryawanForm extends BaseKaryawanForm
{
  public function configure()
  {
        $this->widgetSchema['kode_karyawan'] = new sfWidgetFormInputText();
  }
}
