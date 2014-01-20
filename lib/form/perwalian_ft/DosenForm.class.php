<?php

/**
 * Dosen form.
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class DosenForm extends BaseDosenForm
{
  public function configure()
  {
        $this->widgetSchema['kode_dosen'] = new sfWidgetFormInputText();
  }
}
