<?php

class Person extends BaseModel {
    
    public $id, $username, $password;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public function authenticate() {
        
    }
    
    public function validate_username() {
        return $this->validate_string_length($this->username);
    }
    
    public function validate_password() {
        return $this->validate_string_length($this->password);
    }
}
