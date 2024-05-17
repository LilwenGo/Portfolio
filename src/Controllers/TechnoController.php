<?php
namespace Portfolio\Controllers;
use Portfolio\Models\TechnoManager;

/**
 * Class TechnoController
 */
class TechnoController extends Controller {
    /**
     * Instantiate the needed managers and the validator
     */
    public function __construct() {
        $this->manager = new TechnoManager();
        parent::__construct();
    }

    /**
     * If admin is signe in show index view
     */
    public function index(): void {
        if(isset($_SESSION["user"])) {
            $technos = $this->manager->getAll();
            require VIEWS."Techno/index.php";
        } else {
            //Redirect to login view
            header("Location: /lp-admin/login");
        }
    }

    /**
     * If admin is signed in show edit view
     */
    public function showEdit(int $id): void {
        if(isset($_SESSION["user"])) {
            $techno = $this->manager->find($id);
            require VIEWS."Techno/edit.php";
        } else {
            //Redirect to login view
            header("Location: /lp-admin/login");
        }
    }

    /**
     * Verify the fields and store in database
     */
    public function store(): void {
        if(isset($_SESSION["user"])) {
            $this->validator->validate([
                "name" => ["required", "alphaNum"]
            ]);
            $_SESSION["old"] = $_POST;

            if(!$this->validator->errors()) {
                $this->manager->store();
                unset($_SESSION["old"]);
            }
            header("Location: /lp-admin/technos");
        } else {
            //Redirect to login view
            header("Location: /lp-admin/login");
        }
    }

    /**
     * Update the element into database
     */
    public function update(int $id): void {
        if(isset($_SESSION["user"])) {
            $this->validator->validate([
                "name" => ["required", "alphaNum"]
            ]);
            $_SESSION["old"] = $_POST;

            if(!$this->validator->errors()) {
                $techno = $this->manager->find($id);
                if($techno) {
                    $this->manager->update($techno->getId());
                }
                unset($_SESSION["old"]);
                header("Location: /lp-admin/technos");
            } else {
                header("Location: /lp-admin/technos/".$id."/edit");
            }
        } else {
            //Redirect to login view
            header("Location: /lp-admin/login");
        }
    }

    /**
     * Delete the element from database
     */
    public function delete(int $id): void {
        if(isset($_SESSION["user"])) {
            $techno = $this->manager->find($id);
            if($techno) {
                $this->manager->delete($techno->getId());
            }
            header("Location: /lp-admin/technos");
        } else {
            //Redirect to login view
            header("Location: /lp-admin/login");
        }
    }
}