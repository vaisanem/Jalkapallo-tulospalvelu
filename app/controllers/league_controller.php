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
            $scored = Game::scored($id, $team->id);
            $conceded = Game::conceded($id, $team->id);
            $difference = $scored - $conceded;
            $points = 3 * $wins + $draws;
            $league_team = new LeagueTeam(array('team' => $team, 'played' => $played, 
                'wins' => $wins, 'draws' => $draws, 'losses' => $losses,
                'scored' => $scored, 'conceded' => $conceded, 'difference' => $difference,
                'points' => $points));
            $league_teams[] = $league_team;    
        }
        usort($league_teams, array("LeagueTeam", "mysort"));
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
    
    public static function add_game($id) {
        self::check_logged_in();
        $league = League::find($id);
        $teams = Team::leagues_teams($id);
        View::make('league/add_game.html', array('league' => $league, 'teams' => $teams));
    }
    
    public function store_game($id) {
        $params = $_POST;
        $home_id = $params['home_team'];
        $away_id = $params['away_team'];
        if ($home_id != $away_id) {
            $home_team = Team::find($home_id);
            $away_team = Team::find($away_id);
            $league = League::find($id);
            $attributes = array('league' => $league->id, 'home_team' => $home_team->id,
                'away_team' => $away_team->id, 'home_goals' => $params['home_goals'],
                'away_goals' => $params['away_goals']);
            $game = new Game($attributes);
            $game->save();
            Redirect::to('/sarjat/' . $id, array('message' => 'Ottelutulos lisätty.'));
        } else {
            Redirect::to('/sarjat/' . $id . 'ottelut/lisaa', array('message' => 'Joukkue ei voi pelata itseään vastaan.'));
        }
    }
    
}

