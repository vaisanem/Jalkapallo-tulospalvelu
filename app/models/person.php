<?php

class Person extends BaseModel {
    
    public $id, $name, $password, $mode;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->mode = false;
        $this->validators = array('validate_name', 'validate_password');
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
            'password' => $row['password'],
            'mode' => $row['mode']
            ));
        }

        return $person;
    }
    
    public static function find($param, $attribute) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE ' + $attribute + ' = :' + $attribute);
        $query->execute(array($attribute => $param));
        $row = $query->fetch();
        $person = null;
        
        if ($row) {
            $person = new Person(array(
            'id' => $row['id'],
            'name' => $row['name'],
            'password' => $row['password'],
            'mode' => $row['mode']
            ));
        }

        return $person;
    }
    
    public static function register() {
        $query = DB::connection()->prepare('INSERT INTO Person (name, password) VALUES (:name, :password) RETURNING id');
        $query->execute(array('name' => $this->name, 'password' => $this->password));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_name() {
        $errors = $this->validate_string_length($this->name);
        
        $person = Person::find($this->name, 'name');
        
        if ($this->name == $person->name && $this->id != $person->id) {
            $another = array('Nimi on jo käytössä.');
            $errors = array_merge($errors, $another);
        }
        return $errors;
    }
    
    public function validate_password() {
        return $this->validate_string_length($this->password);
    }
}
