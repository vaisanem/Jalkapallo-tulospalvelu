<?php

class League extends BaseModel {
    
    public $id, $name;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM League');
        $query->execute();
        $rows = $query->fetchAll();
        $leagues = array();

        foreach($rows as $row){
          $leagues[] = new League(array(
            'id' => $row['id'],
            'name' => $row['name']
          ));
        }

        return $leagues;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM League WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        $league = null;
        
        if ($row) {
            $league = new League(array(
            'id' => $row['id'],
            'name' => $row['name'],
            ));
        }

        return $league;
    }
    
    public static function teams_leagues($team_id) {
        $query = DB::connection()->prepare('SELECT * FROM League WHERE id IN (SELECT league_id FROM LeagueTeam WHERE team_id = :id)');
        $query->execute(array('id' => $team_id));
        $rows = $query->fetchAll();
        $leagues = array();
        
        foreach ($rows as $row) {
            $leagues[] = new League(array(
            'id' => $row['id'],
            'name' => $row['name'],
            ));
        }

        return $leagues;
    }
    
    public static function leagues_for_team($team_id) {
        $query = DB::connection()->prepare('SELECT * FROM League WHERE id NOT IN (SELECT league_id FROM LeagueTeam WHERE team_id = :id)');
        $query->execute(array('id' => $team_id));
        $rows = $query->fetchAll();
        $leagues = array();
        
        foreach ($rows as $row) {
            $leagues[] = new League(array(
            'id' => $row['id'],
            'name' => $row['name'],
            ));
        }

        return $leagues;
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO League (name) VALUES (:name) RETURNING id');
        $query->execute(array('name' => $this->name));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function update($id) {
        $query = DB::connection()->prepare('UPDATE League SET name = :name WHERE id = :id');
        $query->execute(array('name' => $this->name, 'id' => $id));
    }
    
    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM League WHERE id = :id');
        $query->execute(array('id' => $id));
    }
    
    public function validate_name() {
        $errors = $this->validate_string_length($this->name);
        
        foreach (League::all() as $league) {
            if ($this->name == $league->name && $this->id != $league->id) {
                $another = array('Nimi on jo käytössä.');
                $errors = array_merge($errors, $another);
                break;
            }
        }
        return $errors;
    }
    
}
