<?php
namespace Portfolio\Models;

/**
 * Class Manager connect to the database
 */
abstract class Manager {
    /**
     * DataBase object PDO
     */
    protected \PDO $bdd;

    /**
     * Connect to the DataBase
     */
    public function __construct() {
        $this->bdd = new \PDO('mysql:host='.HOST.';dbname=' . DATABASE . ';charset=utf8;' , USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Returns the Database
     */
    public function getBdd(): \PDO {
        return $this->bdd;
    }
}