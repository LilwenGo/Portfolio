<?php
namespace Portfolio\Controllers;
use Portfolio\Validator;

abstract class Controller {
    protected Object $manager;
    protected Validator $validator;

    public function __construct() {
        $this->validator = new Validator();
    }
}