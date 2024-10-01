<?php

namespace App\Models;

class UserReset
{
    private $id;
    private $email;
    private $token;

    public function __construct($id, $email, $token)
    {
        $this->id = $id;
        $this->email = $email;
        $this->token = $token;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getToken()
    {
        return $this->token;
    }
}