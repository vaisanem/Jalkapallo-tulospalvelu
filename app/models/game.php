<?php

class Game extends BaseModel {
    
    public $id, $league, $league_name, $home_name, $away_name, $home_goals, $away_goals, $win, $loss;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function teams_games($team_id) {
        $query = DB::connection()->prepare('SELECT * FROM Game WHERE home_team = :id OR away_team = :id');
        $query->execute(array('id' => $team_id));
        $rows = $query->fetchAll();
        $games = array();

        foreach($rows as $row){
          $home_goals = $row['home_goals'];
          $away_goals = $row['away_goals'];
          $game = new Game(array(
            'id' => $row['id'],
            'league' => $row['league'],
            'home_goals' => $home_goals,
            'away_goals' => $away_goals
          ));
          $league = League::find($row['league']);
          $home_team = Team::find($row['home_team']);
          $away_team = Team::find($row['away_team']);
          $game->league_name = $league->name;
          $game->home_name = $home_team->name;
          $game->away_name = $away_team->name;
          //lets check if game was won
          if ($home_team == $team_id) {
              if ($home_goals > $away_goals) {
                  $game->win = true;
              } elseif ($home_goals < $away_goals) {
                  $game->loss = true;
              }
          } else {
              if ($home_goals > $away_goals) {
                  $game->loss = true;
              } elseif ($home_goals < $away_goals) {
                  $game->win = true;
              }
          }
          $games[] = $game;
        }

        return $games;
    }
    
    public static function leagues_games($league_id) {
        $query = DB::connection()->prepare('SELECT * FROM Game WHERE league = :id');
        $query->execute(array('id' => $league_id));
        $rows = $query->fetchAll();
        $games = array();
        
        foreach ($rows as $row) {
            $game = new Game(array(
              'id' => $row['id'],
              'league' => $row['league'],
              'home_goals' => $row['home_goals'],
              'away_goals' => $row['away_goals']
            ));
            $home_team = Team::find($row['home_team']);
            $away_team = Team::find($row['away_team']);
            $game->home_name = $home_team->name;
            $game->away_name = $away_team->name;
            $games[] = $game;
        }
        
        return $games;
    }
    
}
