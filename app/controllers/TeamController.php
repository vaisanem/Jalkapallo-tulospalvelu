<?php
require 'app/models/team.php';
class TeamController extends BaseController {
    
    public static function index() {
        $teams = team::all();
        View::make('suunnitelmat/teams.html', array('teams' => $teams));
    }
    
    public static function find($id) {
        $team = Team::find($id);
        View::make('suunnitelmat/team.html',array('team' => $team));
    }
    
    public static function store() {
        $params = $_POST;
        $team = new Team(array(
            'name' => $params['name'],
            'ground' => $params['ground']
        ));
        
        $team->save();
        
        Redirect::to('/suunnitelmat/joukkueet/' . $team->id, array('message' => 'Joukkue lisätty.'));
    }
    
    public static function create() {
        View::make('suunnitelmat/add_team.html');
    }
}
