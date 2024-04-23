<?php
namespace Portfolio\Models;

/** Class AdminManager **/
class AdminManager {

    private \PDO $bdd;

    public function __construct() {
        $this->bdd = new \PDO('mysql:host='.HOST.';dbname=' . DATABASE . ';charset=utf8;' , USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    //Methode qui retourne la bdd
    public function getBdd(): \PDO {
        return $this->bdd;
    }

    //Methode qui retourne l'auteur d'id $id
    public function getById(string $id): array|bool {
        $stmt = $this->bdd->prepare("SELECT * FROM portfolio_admin WHERE Id = ?");
            $stmt->execute(array(
                $id
            ));
            return $stmt->fetch();
    }

    //Methode qui retourne l'auteur de nom $username
    public function find(string $username): Admin|bool {
        $stmt = $this->bdd->prepare("SELECT * FROM portfolio_admin WHERE username LIKE ?");
        $stmt->execute(array(
            $username
        ));
        $stmt->setFetchMode(\PDO::FETCH_CLASS,"BlogMvc\Models\Admin");

        return $stmt->fetch();
    }

    //Methode qui retourne tous les Admins de la bdd
    public function all(): array {
        $stmt = $this->bdd->query('SELECT * FROM portfolio_admin');

        return $stmt->fetchAll(\PDO::FETCH_CLASS,"Todo\Models\Admin");
    }

    //Methode qui insere un nouvel Admin avec un mot de passe $password
    public function store(string $password): void {
        $stmt = $this->bdd->prepare("INSERT INTO portfolio_admin(id, username, password) VALUES (UUID(), ?, ?)");
        $stmt->execute(array(
            $_POST["username"],
            $password
        ));
    }
}