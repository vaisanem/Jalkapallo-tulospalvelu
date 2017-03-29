<?php

class Team extends BaseModel {
    
    public $id, $name, $ground;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Team');
        $query->execute();
        $rows = $query->fetchAll();
        $teams = array();

        foreach($rows as $row){
          $teams[] = new Team(array(
            'id' => $row['id'],
            'name' => $row['name'],
            'ground' => $row['ground']
          ));
        }

        return $teams;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Team WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        $team = null;
        
        if ($row) {
            $team = new Team(array(
            'id' => $row['id'],
            'name' => $row['name'],
            'ground' => $row['ground']
            ));
        }

        return $team;
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Team (name, ground) VALUES (:name, :ground) RETURNING id');
        $query->execute(array('name' => $this->name, 'ground' => $this->ground));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
}
