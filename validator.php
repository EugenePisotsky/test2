<?php
class Validator {
    function __construct($rules) {
        $this->rules = $rules;
    }

    public function check() {
        foreach ($this->rules as $field => $rules) {
            foreach ($rules as $k => $r) {
                if ($r === 'required') {
                    if (!isset($_POST[$field]))
                        return false;
                }

                if ($r === 'email') {
                    if (!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL))
                        return false;
                }

                if ($k === 'equal') {
                    if ($_POST[$field] != $_POST[$r])
                        return false;
                }

                if ($k === 'min') {
                    if (mb_strlen($_POST[$field], 'UTF-8') < $r)
                        return false;
                }
            }
        }

        return true;
    }
}