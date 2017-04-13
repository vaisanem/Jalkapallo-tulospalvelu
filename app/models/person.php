<?php

class Person extends BaseModel {
    
    public $id, $name, $password, $mode;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->mode = 0;
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
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Person');
        $query->execute();
        $rows = $query->fetchAll();
        $persons = array();

        foreach($rows as $row){
          $persons[] = new Person(array(
            'id' => $row['id'],
            'name' => $row['name'],
            'password' => $row['password'],
            'mode' => $row['mode']
          ));
        }

        return $persons;
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
            'password' => $row['password'],
            'mode' => $row['mode']
            ));
        }

        return $person;
    }
    
    public function register() {
        $query = DB::connection()->prepare('INSERT INTO Person (name, password) VALUES (:name, :password) RETURNING id');
        $query->execute(array('name' => $this->name, 'password' => $this->password));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function give_rights() {
        $query = DB::connection()->prepare('UPDATE Person SET mode = :mode WHERE id = :id');
        $query->execute(array('mode' => 1, 'id' => $this->id));
    }
    
    public function take_rights() {
        $query = DB::connection()->prepare('UPDATE Person SET mode = :mode WHERE id = :id');
        $query->execute(array('mode' => 0, 'id' => $this->id));
    }

    public function validate_name() {
        $errors = $this->validate_string_length($this->name);
        
        foreach (Person::all() as $person) {
            if ($this->name == $person->name && $this->id != $person->id) {
                $another = array('Nimi on jo käytössä.');
                $errors = array_merge($errors, $another);
                break;
            }
        }
        return $errors;
    }
    
    public function validate_password() {
        return $this->validate_string_length($this->password);
    }
}
