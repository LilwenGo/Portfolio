<?php
namespace Portfolio\Controllers;
use Portfolio\Models\ProjectManager;

class ProjectController extends Controller {

    public function __construct() {
        $this->manager = new ProjectManager();
        parent::__construct();
    }

    public function index() {
        require VIEWS."home.php";
    }
}