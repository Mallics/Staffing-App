<?php

//custom validators
class TimeValidation extends Validator {


	// error msg is under /lang/en/validation.php
    public function validateTime($attribute, $value, $parameters){
    	return preg_match('/^\d{1,2}[:]\d{1,2}$/', $value);
        //return preg_match('/^\d{0,2}[:]\d{0,2}[ ][AM|PM]/', $value);
    }

    protected function replaceTime($message, $attribute, $rule, $parameters){
    return str_replace(':attribute', $parameters[0], $message);
	}
}