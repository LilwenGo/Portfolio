<?php
namespace Portfolio\Models;

/**
 *  Class AdminManager 
 */
class AdminManager extends Manager {

    /**
     * Return an array with all the admins
     */
    public function getAll(): array {
        $stmt = $this->bdd->query("SELECT * FROM portfolio_admin");
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Admin::class);
    }

    /**
     * Returns the admin with the corresponding id
     */
    public function getById(string $id): Admin|bool {
        $stmt = $this->bdd->prepare("SELECT * FROM portfolio_admin WHERE Id = ?");
        $stmt->execute(array(
            $id
        ));
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Admin::class);
        return $stmt->fetch();
    }

    /**
     * Returns the admin with the corresponding username
     */
    public function find(string $username): Admin|bool {
        $stmt = $this->bdd->prepare("SELECT * FROM portfolio_admin WHERE username LIKE ?");
        $stmt->execute(array(
            $username
        ));
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Admin::class);

        return $stmt->fetch();
    }

    /**
     * Insert a new admin in the database
     */
    public function store(string $password): void {
        $stmt = $this->bdd->prepare("INSERT INTO portfolio_admin(username, password) VALUES (?, ?)");
        $stmt->execute(array(
            $_POST["username"],
            $password
        ));
    }

    /**
     * Updates the admin with the coresponding id
     */
    public function update(int $id): void {
        $stmt = $this->bdd->prepare("UPDATE portfolio_admin SET username = ? WHERE id = ?");
        $stmt->execute([
            $_POST["username"],
            $id
        ]);
    }

    /**
     * Deletes the admin with the corresponding id
     */
    public function delete(int $id): void {
        $stmt = $this->bdd->prepare('DELETE FROM portfolio_admin WHERE id = ?');
        $stmt->execute([
            $id
        ]);
    }
}