<?php
namespace Portfolio\Controllers;

use Portfolio\Controllers\Controller;
use Portfolio\Models\AdminManager;
/**
 * Class AdminController
 */
class AdminController extends Controller {

    /**
     * Instantiate the needed managers and the validator
     */
    public function __construct() {
        $this->manager = new AdminManager();
        parent::__construct();
    }
    
    /**
     * If admin is not signed in show register view
     */
    public function index(): void {
        if(isset($_SESSION["user"]["id"])) {
            $admins = $this->manager->getAll();
            require VIEWS . 'Auth/admins.php';
        } else {
            header("Location: /lp-admin/login");
        }
    }

    /**
     * If admin is not signed in show login view
     */
    public function showLogin(): void {
        if(!isset($_SESSION["user"]["id"])) {
            require VIEWS . 'Auth/login.php';
        } else {
            header("Location: /");
        }
    }
    
    /**
     * If admin is signed in show edit view
     */
    public function showEdit(int $id): void {
        if(isset($_SESSION["user"]["id"])) {
            $admin = $this->manager->getById($id);
            if($admin) {
                require VIEWS . 'Auth/edit.php';
            } else {
                header("Location:");
            }
        } else {
            header("Location: /lp-admin/login");
        }
    }

    /**
     * Destroy the admin session
     */
    public function logout(): void {
        session_start();
        session_destroy();
        header('Location: /');
    }

    /**
     * Verify the fields in the $_POST and create a new user
     * before to login with it
     */
    public function register(): void {
        if(isset($_SESSION["user"])) {
            //Valide les champs
            $this->validator->validate([
                "username"=>["required", "min:3", "max:9", "alphaNum"],
                "password"=>["required", "min:6", "alphaNum", "confirm"],
                "passwordConfirm"=>["required", "min:6", "alphaNum"]
            ]);
            //Stocke en old
            $_SESSION['old'] = $_POST;
    
            if (!$this->validator->errors()) {
                //Si validé recherche d'utilisateur avec le même nom
                $res = $this->manager->find($_POST["username"]);
    
                if (empty($res)) {
                    //Si pas de même nom cryptage du mot de passe
                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    //Insertion du nouvel utilisateur
                    $this->manager->store($password);
                } else {
                    //Si même nom alors erreur
                    $_SESSION["error"]['username'] = "Le nom d'utilisateur choisi est déjà utilisé !";
                }
            }
            header("Location: /lp-admin/admins");
        } else {
            header("Location: /lp-admin/login");
        }
    }

    /**
     * Verify the fields and login if password correct
     */
    public function login(): void {
        //Valide les champs
        $this->validator->validate([
            "username"=>["required", "min:3", "max:9", "alphaNum"],
            "password"=>["required", "min:6", "alphaNum"]
        ]);
        //Stocke en old
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            //Si validé chercher si même nom qu'en bdd
            $res = $this->manager->find($_POST["username"]);

            if ($res && password_verify($_POST['password'], $res->getPassword())) {
                //Si pas même nom stockage des donnés de user en session
                $_SESSION["user"] = [
                    "id" => $res->getId(),
                    "username" => $res->getUsername()
                ];
                //Redirection affichage
                header("Location: /");
            } else {
                //Si même nom erreur
                $_SESSION["error"]['password'] = "Une erreur sur les identifiants";
                //Retour login
                header("Location: /lp-admin");
            }
        } else {
            //Si pas validé retour login
            header("Location: /lp-admin");
        }
    }

    /**
     * Verify the field and update the admin name
     */
    public function update(int $id): void {
        if(isset($_SESSION["user"])) {
            //Valide le champ
            $this->validator->validate([
                "username"=>["required", "min:3", "max:9", "alphaNum"]
            ]);
            //Stocke en old
            $_SESSION['old'] = $_POST;

            if (!$this->validator->errors()) {
                //Si validé chercher si même nom qu'en bdd
                $res = $this->manager->find($_POST["username"]);

                if (!$res) {
                    $this->manager->update($id);
                    unset($_SESSION['old']);
                    header("Location: /lp-admin/admins");
                } else {
                    //Si même nom erreur
                    $_SESSION["error"]['name'] = "Le nom est déja utilisé !";
                    //Retour login
                    header("Location: /lp-admin/admins");
                }
            } else {
                //Si pas validé retour login
                header("Location: /lp-admin/admins/".$id."/edit");
            }
        } else {
            //Si pas validé retour login
            header("Location: /lp-admin/login");
        }
    }

    /**
     * If admin is logued delete the admin with corresponding id
     */
    public function delete(int $id): void {
        if(isset($_SESSION["user"])) {
            //Search the admin
            $admin = $this->manager->getById($id);
            if($admin) {
                //If founded delete it
                $this->manager->delete($admin->getId());
            }
            //Back to admins view
            header("Location: /lp-admin/admins");
        } else {
            //If not logued go to login view
            header("Location: /lp-admin/login");
        }
    }
}
?>