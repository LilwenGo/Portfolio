<?php
namespace Portfolio\Models;

/** Class Admin represents the database table Admin **/
class Admin {

    /**
     * Admin's id
     */
    private string $id;
    /**
     * Admin's username
     */
    private string $username;
    /**
     * Admin's password
     */
    private string $password;

    //Accessors

    /**
     * Returns admin's id
     */
    public function getId(): string {
        return $this->id;
    }
    
    /**
     * Returns admin's username
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * Returns admin's password
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * Set admin's id
     */
    public function setId(int $id) {
        $this->id = $id;
    }

    /**
     * Set admin's username
     */
    public function setUsername(string $username) {
        $this->username = $username;
    }

    /**
     * Set admin's password
     */
    public function setPassword(string $password) {
        $this->password = $password;
    }
}