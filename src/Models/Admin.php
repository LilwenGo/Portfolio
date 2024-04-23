<?php
namespace Portfolio\Models;

/** Class User **/
class Admin {

    private string $id;
    private string $username;
    private string $password;

    //accesseurs
    public function getId(): string {
        return $this->id;
    }
    
    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function setUsername(string $username) {
        $this->username = $username;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }
}