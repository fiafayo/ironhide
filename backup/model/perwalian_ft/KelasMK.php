<?php

/**
 * Subclass for representing a row from the 'tk_kelas_mk' table.
 *
 *
 *
 * @package lib.model.perwalian_ft
 */
class KelasMK extends BaseKelasMK
{
  public function __toString()
  {
    $mk=$this->getMataKuliah();
    if ($mk) return $mk->getNama().' (KP:'.$this->getKp().')';
    else    return $this->getKodeMk().' (KP:'.$this->getKp().')';
  }
}
