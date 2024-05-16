<?php

namespace Portfolio;

/**
 *  Class Validator validate the fields given and store the errors.
 */
class Validator {

    /**
     * Data to validate
     */
    private $data;
    /**
     * Errors list
     */
    private $errors = [];
    /**
     * Error messages list
     */
    private $messages = [
        "required" => "Le champ est requis !",
        "min" => "Le champ doit contenir un minimum de %^% lettres !",
        "max" => "Le champ doit contenir un maximum de %^% lettres !",
        "regex" => "Le format n'est pas respecté",
        "length" => "Le champ doit contenir %^% caractère(s) !",
        "url" => "Le champ doit correspondre à une url !",
        "email" => "Le champ doit correspondre à une email: exemple@gmail.com !",
        "date" => "Le champ doit être une date !",
        "alpha" => "Le champ peut contenir que des lettres minuscules et majuscules !",
        "alphaNum" => "Le champ peut contenir que des lettres minuscules, majuscules et des chiffres !",
        "alphaNumDash" => "Le champ peut contenir que des lettres minuscules, majuscules, des chiffres, des slash et des tirets !",
        "alphaSpaceAccent" => "Le champ peut contenir que des lettres minuscules, majuscules, avec accent ou des espaces !",
        "numeric" => "Le champ peut contenir que des chiffres !",
        "confirm" => "Le champs n'est pas conforme au confirm !"
    ];
    /**
     * Rules list
     */
    private $rules = [
        "required" => "#^.+$#",
        "min" => "#^.{ù,}$#",
        "max" => "#^.{0,ù}$#",
        "length" => "#^.{ù}$#",
        "regex" => "ù",
        "url" => FILTER_VALIDATE_URL,
        "email" => FILTER_VALIDATE_EMAIL,
        "date" => "#^(\d{4})(\/|-)(0[0-9]|1[0-2])(\/|-)([0-2][0-9]|3[0-1])$#",
        "alpha" => "#^[A-z]+$#",
        "alphaNum" => "#^[A-z0-9]+$#",
        "alphaNumDash" => "#^[A-z0-9-\|]+$#",
        "alphaSpaceAccent" => "#^[A-z À-ú]+$#",
        "numeric" => "#^[0-9]+$#",
        "confirm" => ""
    ];

    /**
     * Get an array of the data to validate.
     * If not data given get the POST data
     */
    public function __construct(array $data = []) {
        $this->data = $data ?: $_POST;
    }

    /**
     * Verify the fields with the rules specified
     * The array given must be of the form
     * ["field1" => ["rule1", "rule2", "rule3"],
     * "field2" => ["rule1", "rule2", "rule3"]]
     * For example:
     * <code>
     * <?php
     * $validator->validate(["username" => ["required", "min:3", "alpha"]])
     * ?>
     * </code>
     */
    public function validate(array $array): void {
        foreach ($array as $field => $rules) {
            $this->validateField($field, $rules);
        }
    }

    /**
     * For each rule from a field verify the rule
     */
    public function validateField(string $field, array $rules): void {
        foreach ($rules as $rule) {
            $this->validateRule($field, $rule);
        }
    }

    /**
     * Verify the rule given is respected by the field
     */
    public function validateRule(string $field, string $rule) {
        $res = strrpos($rule, ":");
        if ($res == true) {
            $repRule = explode(":", $rule);
            $changeRule = str_replace("ù", $repRule[1], $this->rules[$repRule[0]]);
            $changeMessage = str_replace("%^%", $repRule[1], $this->messages[$repRule[0]]);

            if (!preg_match($changeRule, $this->data[$field])) {
                $this->errors = [$this->messages[$repRule[0]]];
                $this->storeSession($field, $changeMessage);
            }
        } elseif ($res == false) {
            if ($rule == "confirm") {
                if (!isset($this->data[$field . 'Confirm'])) {
                    $this->errors = ["Nous buttons sur un problème"];
                    $this->storeSession('confirm', "Nous buttons sur un problème");
                } elseif (isset($this->data[$field . 'Confirm']) && $this->data[$field] != $this->data[$field . 'Confirm']) {
                    $this->errors = [$this->messages[$rule]];
                    $this->storeSession('confirm', $this->messages[$rule]);
                }
                return;
            }
            if ($rule == "email" || $rule == "url") {
                if (!filter_var($this->data[$field], $this->rules[$rule])) {
                    $this->errors = [$this->messages[$rule]];
                    $this->storeSession($field, $this->messages[$rule]);
                }
            }
            elseif (!preg_match($this->rules[$rule], $this->data[$field])) {
                $this->errors = [$this->messages[$rule]];
                $this->storeSession($field, $this->messages[$rule]);
            }
        }
    }

    /**
     * Return the errors in the validation
     */
    public function errors(): array {
        return $this->errors;
    }

    /**
     * Store an error in the session
     */
    public function storeSession(string $field, string $error) {
        if (!isset($_SESSION["error"][$field])) {
            $_SESSION["error"][$field] = $error;
        } else {
            return;
        }
    }
}
