<?php

/**
 * Informasi filter form.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class InformasiFormFilter extends BaseInformasiFormFilter
{
  public function configure()
  {
       unset(
        $this['created_at'], $this['updated_at'],
        $this['state'], $this['tanggal'], $this['jenis'], $this['instansi_id']
       );
  }
}
