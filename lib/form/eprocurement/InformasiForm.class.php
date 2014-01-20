<?php

/**
 * Informasi form.
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class InformasiForm extends BaseInformasiForm
{
  public function configure()
  {
       unset(
        $this['created_at'], $this['updated_at'],
        $this['state'], $this['tanggal'], $this['jenis'], $this['instansi_id']
       );
        

  }
}
