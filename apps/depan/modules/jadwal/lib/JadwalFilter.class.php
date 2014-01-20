<?php
class JadwalFilterForm extends sfForm
{
    private $jurusanOptions=array();
    public function configure()
    {
        $jurusans=JurusanPeer::doSelect(new Criteria());
        $this->jurusanOptions=array();
        foreach ($jurusans as $jurusan)
        {
            $jurusanOptions[$jurusan->getKodeJur()]=$jurusan->getNama();
        }
        $this->setWidgets(array(
            'jurusan_id'    => new sfWidgetFormChoice(array(
               'choices' => $this->jurusanOptions,
               'expanded' => false
            ))
        ));
    }
}
