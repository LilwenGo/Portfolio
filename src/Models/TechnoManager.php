<?php
namespace Portfolio\Models;

/**
 * Class TechnoManager
 */
class TechnoManager extends Manager {
    /**
     * Returns an array of all technos
     */
    public function getAll(): array {
        $stmt = $this->bdd->query("SELECT id, techno_name AS libelle FROM portfolio_techno");
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Techno::class);
    }

    /**
     * Returns a techno with corresponding id
     */
    public function find(int $id): Techno|bool {
        $stmt = $this->bdd->prepare("SELECT id, techno_name AS libelle FROM portfolio_techno WHERE id = ?");
        $stmt->execute([
            $id
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Techno::class);
        return $stmt->fetch();
    }

    /**
     * Insert a techno into database
     */
    public function store(): void {
        $stmt = $this->bdd->prepare("INSERT INTO portfolio_techno (techno_name) VALUES (?)");
        $stmt->execute([
            $_POST["name"]
        ]);
    }

    /**
     * Update a techno into database
     */
    public function update(int $id): void {
        $stmt = $this->bdd->prepare("UPDATE portfolio_techno SET techno_name = ? WHERE id = ?");
        $stmt->execute([
            $_POST["name"],
            $id
        ]);
    }

    /**
     * Delete a techno from database
     */
    public function delete(int $id): void {
        $stmt = $this->bdd->prepare("DELETE FROM portfolio_techno WHERE id =?");
        $stmt->execute([
            $id
        ]);
    }
}