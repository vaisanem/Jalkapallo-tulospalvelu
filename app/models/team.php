<?php

class Team extends BaseModel {
    
    public $id, $name, $ground;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
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
    
    public function update($id) {
        $query = DB::connection()->prepare('UPDATE Team SET name = :name, ground = :ground WHERE id = :id');
        $query->execute(array('name' => $this->name, 'ground' => $this->ground, 'id' => $id));
    }
    
    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Team WHERE id = :id');
        $query->execute(array('id' => $id));
    }
    
    public function add_to_league($id) {
        $query = DB::connection()->prepare('INSERT INTO LeagueTeam (team_id, league_id) VALUES (:team_id, :league_id)');
        $query->execute(array('team_id' => $this->id, 'league_id' => $id));
    }
    
    public static function leagues_teams($league_id) {
        $query = DB::connection()->prepare('SELECT * FROM Team WHERE id IN (SELECT team_id FROM LeagueTeam WHERE league_id = :id)');
        $query->execute(array('id' => $league_id));
        $rows = $query->fetchAll();
        $teams = array();
        
        foreach ($rows as $row) {
            $teams[] = new Team(array(
            'id' => $row['id'],
            'name' => $row['name'],
            'ground' => $row['ground']
            ));
        }

        return $teams;
    }
    
    public function validate_name() {
        $errors = $this->validate_string_length($this->name, null);
        
        foreach (Team::all() as $team) {
            if ($this->name == $team->name && $this->id != $team->id) {
                $another = array('Nimi on jo käytössä.');
                $errors = array_merge($errors, $another);
                break;
            }
        }
        return $errors;
    }
    
}
