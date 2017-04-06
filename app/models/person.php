<?php

class Person extends BaseModel {
    
    public $id, $name, $password;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function authenticate($name, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE name = :name AND password = :password');
        $query->execute(array('name' => $name, 'password' => $password));
        $row = $query->fetch();
        $person = null;
        
        if ($row) {
            $person = new Person(array(
            'id' => $row['id'],
            'name' => $row['name'],
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
            'name' => $row['name'],
            'password' => $row['password']
            ));
        }

        return $person;
    }


    public function validate_name() {
        return $this->validate_string_length($this->name);
    }
    
    public function validate_password() {
        return $this->validate_string_length($this->password);
    }
}
