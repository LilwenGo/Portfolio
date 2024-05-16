<?php
namespace Portfolio\Controllers;
use Portfolio\Models\ProjectManager;

/** Class ProjectController */
class ProjectController extends Controller {

    /**
     * Instantiate the needed managers
     */
    public function __construct() {
        $this->manager = new ProjectManager();
        parent::__construct();
    }

    /**
     * Redirect to the home page
     */
    public function index() {
        require VIEWS."home.php";
    }
}