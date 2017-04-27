<?php

class LeagueController extends BaseController {
    
    public static function index() {
        $leagues = League::all();
        View::make('league/leagues.html', array('leagues' => $leagues));
    }
    
    public static function find($id) {
        $league = League::find($id);
        $teams = Team::leagues_teams($id);
        $league_teams = array();
        foreach ($teams as $team) {
            $played = Game::played($id, $team->id);
            $wins = Game::wins($id, $team->id);
            $losses = Game::losses($id, $team->id);
            $draws = $played - $wins - $losses;
            $h_scored = Game::home_scored($id, $team->id);
            $a_scored = Game::away_scored($id, $team->id);
            $scored = $h_scored + $a_scored;
            $h_conceded = Game::home_conceded($id, $team->id);
            $a_conceded = Game::away_conceded($id, $team->id);
            $conceded = $h_conceded + $a_conceded;
            $difference = $scored - $conceded;
            $points = 3 * $wins + $draws;
            $league_team = new LeagueTeam(array('team' => $team, 'played' => $played, 
                'wins' => $wins, 'draws' => $draws, 'losses' => $losses,
                'scored' => $scored, 'conceded' => $conceded, 'difference' => $difference,
                'points' => $points));
            $league_teams[] = $league_team;
            
        }
        View::make('league/league.html', array('league' => $league, 'teams' => $league_teams));
    }
    
    public static function create() {
        self::check_logged_in();
        View::make('league/add_league.html');
    }

    public static function store() {
        $params = $_POST;
        $attributes = array('name' => $params['name']);
        $league = new League($attributes);
        
        $errors = $league->errors();
        
        if (count($errors) > 0) {
            View::make('league/add_league.html', array('errors' => $errors, 'attributes' => $attributes));
            
        } else {
            $league->save();
            Redirect::to('/sarjat/' . $league->id, array('message' => 'Sarja lisätty.'));
        }
    }
    
    public static function edit($id) {
        self::check_logged_in();
        $league = League::find($id);
        View::make('league/edit_league.html', array('league' => $league));
    }
    
    public static function update($id) {
        $params = $_POST;
        $attributes = array('id' => $id, 'name' => $params['name']);
        $league = new League($attributes);
        
        $errors = $league->errors();
        
        if (count($errors) > 0) {
            View::make('league/edit_league.html', array('errors' => $errors, 'attributes' => $attributes));
            
        } else {
            $league->update($id);
            Redirect::to('/sarjat/' . $id, array('message' => 'Sarjaa muokattu.'));
        }
    }
    
    public static function destroy($id) {
        League::destroy($id);
        Redirect::to('/sarjat', array('message' => 'Sarja on poistettu onnistuneesti.'));
    }
}

