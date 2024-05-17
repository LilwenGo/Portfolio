<?php
namespace Portfolio\Models;

/**
 * Class Techno represents the table techno
 */
class Techno {
    /**
     * Techno's id
     */
    private int $id;

    /**
     * Techno's libelle
     */
    private string $libelle;

    //Accessors
    /**
     * Returns techno's id
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Returns techno's libelle
     */
    public function getLibelle(): string {
        return $this->libelle;
    }

    /**
     * Set techno's id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Set techno's libelle
     */
    public function setLibelle(string $libelle): void {
        $this->libelle = $libelle;
    }
}