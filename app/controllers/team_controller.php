<?php
require 'app/models/team.php';
class TeamController extends BaseController {
    
    public static function index() {
        $teams = team::all();
        View::make('team/teams.html', array('teams' => $teams));
    }
    
    public static function find($id) {
        $team = Team::find($id);
        $teams_leagues = League::teams_leagues($id);
        $leagues_for_team = League::leagues_for_team($id);
        $games = Game::teams_games($id);
        View::make('team/team.html',array('team' => $team, 'teams_leagues' => $teams_leagues,
            'leagues_for_team' => $leagues_for_team, 'games' => $games));
    }
    
    public static function create() {
        self::check_logged_in();
        View::make('team/add_team.html');
    }
    
    public static function store() {
        $params = $_POST;
        $attributes = array('name' => $params['name'], 'ground' => $params['ground']);
        $team = new Team($attributes);
        
        $errors = $team->errors();
        
        if (count($errors) > 0) {
            View::make('team/add_team.html', array('errors' => $errors, 'attributes' => $attributes));
            
        } else {
            $team->save();
            Redirect::to('/joukkueet/' . $team->id, array('message' => 'Joukkue lisätty.'));
        }
    }
    
    public static function edit($id) {
        self::check_logged_in();
        $team = Team::find($id);
        View::make('team/edit_team.html', array('attributes' => $team));
    }
    
    public static function update($id) {
        $params = $_POST;
        $attributes = array('id' => $id, 'name' => $params['name'], 'ground' => $params['ground']);
        $team = new Team($attributes);
        
        $errors = $team->errors();
        
        if (count($errors) > 0) {
            View::make('team/edit_team.html', array('errors' => $errors, 'attributes' => $attributes));
            
        } else {
            $team->update($id);
            Redirect::to('/joukkueet/' . $id, array('message' => 'Joukkuetta muokattu.'));
        }
    }
    
    public static function destroy($id) {
        Team::destroy($id);
        Redirect::to('/joukkueet', array('message' => 'Joukkue on poistettu onnistuneesti.'));
    }
    
    public static function add_to_league($id) {
        $league_id = $_POST['league'];
        $team = Team::find($id);
        $team->add_to_league($league_id);
        Redirect::to('/joukkueet/' . $id);
    }
}

