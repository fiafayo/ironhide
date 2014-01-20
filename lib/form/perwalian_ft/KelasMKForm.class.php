<?php

/**
 * KelasMK form.
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class KelasMKForm extends BaseKelasMKForm
{
  public function configure()
  {
      $this->useFields(
        array(
            'kode_kelas',
            'kode_mk',
            'kp',
            'kapasitas',
            'isi',
            'status_buka'
        )
      );
  }
}
