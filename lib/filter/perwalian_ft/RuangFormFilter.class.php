<?php

/**
 * Ruang filter form.
 *
 * @package    perwalianft
 * @subpackage filter
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class RuangFormFilter extends BaseRuangFormFilter
{
  public function configure()
  {
        unset( $this['ruang_block_list'] );
        $this->widgetSchema['jenis'] = new sfWidgetFormChoice(array(
            'choices' => RuangPeer::$jenises,
            'expanded' => false,
        ));
  }
}
