<?php

class Login extends BaseObject
{
    protected $username;
    protected $password;
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setUsername($v)
    {
        $this->username=$v;
    }
    public function setPassword($v)
    {
        $this->password=$v;
    }
 
}