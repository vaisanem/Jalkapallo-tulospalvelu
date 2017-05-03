<?php

class Game extends BaseModel {
    
    public $id, $league, $home_team, $away_team, $home_goals, $away_goals, $win, $loss;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Game (league, home_team, away_team, home_goals, away_goals) VALUES (:league, :home_team, :away_team, :home_goals, :away_goals) RETURNING id');
        $query->execute(array('league' => $this->league, 'home_team' => $this->home_team, 'away_team' => $this->away_team, 'home_goals' => $this->home_goals, 'away_goals' => $this->away_goals));
        $row = $query->fetch();
        $this->id = $row['id'];
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
            'id' => $row['league'],
            'home_goals' => $home_goals,
            'away_goals' => $away_goals
          ));
          $league = League::find($row['league']);
          $home_team = Team::find($row['home_team']);
          $away_team = Team::find($row['away_team']);
          $game->league = $league->name;
          $game->home_team = $home_team->name;
          $game->away_team = $away_team->name;
          //lets check if game was won
          if ($home_team->id == $team_id) {
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
              'id' => $row['league'],
              'home_goals' => $row['home_goals'],
              'away_goals' => $row['away_goals']
            ));
            $league = League::find($row['league']);
            $home_team = Team::find($row['home_team']);
            $away_team = Team::find($row['away_team']);
            $game->league = $league->name;
            $game->home_team = $home_team->name;
            $game->away_team = $away_team->name;
            $games[] = $game;
        }
        
        return $games;
    }
    
    public static function played($league_id, $team_id) {
        $query = DB::connection()->prepare('SELECT COUNT(*) as played FROM Game WHERE league = :league_id AND (home_team = :team_id OR away_team = :team_id)');
        $query->execute(array('league_id' => $league_id, 'team_id' => $team_id));
        $row = $query->fetch();
        $played = 0;
        
        if ($row) {
            $played = $row['played'];
        }

        return $played;
    }
    
    public static function wins($league_id, $team_id) {
        $query = DB::connection()->prepare('SELECT COUNT(*) as wins FROM Game WHERE league = :league_id AND ((home_team = :team_id AND home_goals > away_goals) OR (away_team = :team_id AND away_goals > home_goals))');
        $query->execute(array('league_id' => $league_id, 'team_id' => $team_id));
        $row = $query->fetch();
        $wins = 0;
        
        if ($row) {
            $wins = $row['wins'];
        }

        return $wins;
    }
    
    public static function losses($league_id, $team_id) {
        $query = DB::connection()->prepare('SELECT COUNT(*) as losses FROM Game WHERE league = :league_id AND ((home_team = :team_id AND home_goals < away_goals) OR (away_team = :team_id AND away_goals < home_goals))');
        $query->execute(array('league_id' => $league_id, 'team_id' => $team_id));
        $row = $query->fetch();
        $losses = 0;
        
        if ($row) {
            $losses = $row['losses'];
        }

        return $losses;
    }
    
    public static function home_scored($league_id, $team_id) {
        $query = DB::connection()->prepare('SELECT SUM(home_goals) as scored FROM Game WHERE league = :league_id AND home_team = :team_id');
        $query->execute(array('league_id' => $league_id, 'team_id' => $team_id));
        $row = $query->fetch();
        $scored = 0;
        
        if ($row) {
            $scored = $row['scored'];
        }

        return $scored;
    }
    
    public static function away_scored($league_id, $team_id) {
        $query = DB::connection()->prepare('SELECT SUM(away_goals) as scored FROM Game WHERE league = :league_id AND away_team = :team_id');
        $query->execute(array('league_id' => $league_id, 'team_id' => $team_id));
        $row = $query->fetch();
        $scored = 0;
        
        if ($row) {
            $scored = $row['scored'];
        }

        return $scored;
    }
    
    public static function scored($league_id, $team_id) {
        $query = DB::connection()->prepare('SELECT * FROM (SELECT SUM(home_goals) as home FROM Game WHERE league = :league_id AND home_team = :team_id) a INNER JOIN (SELECT SUM(away_goals) as away FROM Game WHERE league = :league_id AND away_team = :team_id) b ON 1=1');
        $query->execute(array('league_id' => $league_id, 'team_id' => $team_id));
        $row = $query->fetch();
        $scored = 0;
        
        if ($row) {
            $scored = $row['home'] + $row['away'];
        }

        return $scored;
    }
    
    public static function home_conceded($league_id, $team_id) {
        $query = DB::connection()->prepare('SELECT SUM(home_goals) as conceded FROM Game WHERE league = :league_id AND away_team = :team_id');
        $query->execute(array('league_id' => $league_id, 'team_id' => $team_id));
        $row = $query->fetch();
        $conceded = 0;
        
        if ($row) {
            $conceded = $row['conceded'];
        }

        return $conceded;
    }
    
    public static function away_conceded($league_id, $team_id) {
        $query = DB::connection()->prepare('SELECT SUM(away_goals) as conceded FROM Game WHERE league = :league_id AND home_team = :team_id');
        $query->execute(array('league_id' => $league_id, 'team_id' => $team_id));
        $row = $query->fetch();
        $conceded = 0;
        
        if ($row) {
            $conceded = $row['conceded'];
        }

        return $conceded;
    }
    
    public static function conceded($league_id, $team_id) {
        $query = DB::connection()->prepare('SELECT * FROM (SELECT SUM(away_goals) as home FROM Game WHERE league = :league_id AND home_team = :team_id) a INNER JOIN (SELECT SUM(home_goals) as away FROM Game WHERE league = :league_id AND away_team = :team_id) b ON 1=1');
        $query->execute(array('league_id' => $league_id, 'team_id' => $team_id));
        $row = $query->fetch();
        $conceded = 0;
        
        if ($row) {
            $conceded = $row['home'] + $row['away'];
        }

        return $conceded;
    }
    
}
