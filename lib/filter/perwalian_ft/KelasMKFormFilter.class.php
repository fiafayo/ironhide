<?php

/**
 * KelasMK filter form.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class KelasMKFormFilter extends BaseKelasMKFormFilter
{
  public function configure()
  {
      $this->useFields(
        array(
             
            'kode_mk',
            'kp' 
            
        )
      );
  }
}
