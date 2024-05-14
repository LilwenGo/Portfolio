<?php
namespace Portfolio\Models;

abstract class Manager {
    protected \PDO $bdd;

    public function __construct() {
        $this->bdd = new \PDO('mysql:host='.HOST.';dbname=' . DATABASE . ';charset=utf8;' , USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    //Methode qui retourne la bdd
    public function getBdd(): \PDO {
        return $this->bdd;
    }
}