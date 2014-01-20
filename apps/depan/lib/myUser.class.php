<?php

class myUser extends sfBasicSecurityUser
{

    public function getId()
    {
        $id=$this->getAttribute('id',0,'login');
        return $id;
    }
    public function getNama()
    {
        $v=$this->getAttribute('nama','undefined','login');
        return $v;
    }
    public function getNrp()
    {
        $v=$this->getAttribute('nrp','0','login');
        return $v;
    }
    public function getNpk()
    {
        $v=$this->getAttribute('npk','0','login');
        return $v;
    }
    public function getKodeDosen()
    {
        $v=$this->getAttribute('kode_dosen','0','login');
        return $v;
    }


    public function isAdministrator()
    {
        return ($this->hasCredential('administrator') or $this->hasCredential('admin'));
    }
    public function isDosen()
    {
        return ($this->hasCredential('dosen'));
    }
    public function isMahasiswa()
    {
        return ($this->hasCredential('mahasiswa'));
    }
    public function isKetuaJurusan()
    {
        return ($this->hasCredential('ketua_jurusan'));
    }
    public function isPaj()
    {
        return ($this->hasCredential('paj'));
    }
    public function isKasusKhusus()
    {
        return ($this->hasCredential('kasus_khusus'));
    }

}
