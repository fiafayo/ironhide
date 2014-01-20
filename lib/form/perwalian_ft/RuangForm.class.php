<?php

/**
 * Ruang form.
 *
 * @package    perwalianft
 * @subpackage form
 * @author     Sholeh Hadi Setyawan
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class RuangForm extends BaseRuangForm
{
  public function configure()
  {
        unset( $this['ruang_block_list'] );
        $this->widgetSchema['jenis'] = new sfWidgetFormChoice(array(
            'choices' => RuangPeer::$jenises,
            'expanded' => false,
        ));
        $this->widgetSchema['kode_ruang'] = new sfWidgetFormInputText();

  }
}
