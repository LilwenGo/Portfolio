<?php
namespace Portfolio\Controllers;
use Portfolio\Validator;

/**
 * Class Controller implements common code
 */
abstract class Controller {
    /**
     * Manager object property
     */
    protected Object $manager;
    /**
     * Validator object
     */
    protected Validator $validator;

    /**
     * Instantiate validator
     */
    public function __construct() {
        $this->validator = new Validator();
    }
}