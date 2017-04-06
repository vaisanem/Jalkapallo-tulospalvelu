<?php

class Person extends BaseModel {
    
    public $id, $username, $password;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function authenticate($username, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE username = :username AND password = :password');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        $person = null;
        
        if ($row) {
            $person = new Person(array(
            'id' => $row['id'],
            'username' => $row['username'],
            'password' => $row['password']
            ));
        }

        return $person;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        $person = null;
        
        if ($row) {
            $person = new Person(array(
            'id' => $row['id'],
            'username' => $row['username'],
            'password' => $row['password']
            ));
        }

        return $person;
    }


    public function validate_username() {
        return $this->validate_string_length($this->username);
    }
    
    public function validate_password() {
        return $this->validate_string_length($this->password);
    }
}
