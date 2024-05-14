<?php
namespace Portfolio\Models;

/** Class AdminManager **/
class AdminManager extends Manager {

    //Méthode qui retourne tous les admins
    public function getAll(): array {
        $stmt = $this->bdd->query("SELECT * FROM portfolio_admin");
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Admin::class);
    }

    //Methode qui retourne l'auteur d'id $id
    public function getById(string $id): Admin|bool {
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
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Admin::class);

        return $stmt->fetch();
    }

    //Methode qui retourne tous les Admins de la bdd
    public function all(): array {
        $stmt = $this->bdd->query('SELECT * FROM portfolio_admin');

        return $stmt->fetchAll(\PDO::FETCH_CLASS, Admin::class);
    }

    //Methode qui insere un nouvel Admin avec un mot de passe $password
    public function store(string $password): void {
        $stmt = $this->bdd->prepare("INSERT INTO portfolio_admin(id, username, password) VALUES (UUID(), ?, ?)");
        $stmt->execute(array(
            $_POST["username"],
            $password
        ));
    }

    //Méthode de modification d'admin
    public function update(int $id): void {
        $stmt = $this->bdd->prepare("UPDATE portfolio_admin SET username = ? WHERE id = ?");
        $stmt->execute([
            $_POST["name"],
            $id
        ]);
    }
}