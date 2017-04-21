<?php

class game extends BaseModel {
    
    public $id, $league, $home_team, $away_team, $home_goals, $away_goals;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function teams_games($team_id) {
        $query = DB::connection()->prepare('SELECT * FROM Game WHERE home_team = :id OR away_team = :id');
        $query->execute(array('id' => $team_id));
        $rows = $query->fetchAll();
        $games = array();

        foreach($rows as $row){
          $games[] = new Game(array(
            'id' => $row['id'],
            'league' => $row['league'],
            'home_team' => $row['home_team'],
            'away_team' => $row['away_team'],
            'home_goals' => $row['home_goals'],
            'away_goals' => $row['away_goals']
          ));
        }

        return $games;
    }
    
    public static function leagues_games($league_id) {
        
    }
    
}
