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
    
    public static function create() {
        View::make('suunnitelmat/add_team.html');
    }
    
    public static function store() {
        $params = $_POST;
        $attributes = array('name' => $params['name'], 'ground' => $params['ground']);
        $team = new Team($attributes);
        
        $errors = $team->errors();
        
        if (count($errors) > 0) {
            View::make('suunnitelmat/add_team.html', $errors, $attributes);
            
        } else {
            $team->save();
            Redirect::to('/suunnitelmat/joukkueet/' . $team->id, array('message' => 'Joukkue lisätty.'));
        }
    }
    
    public static function edit($id) {
        $team = Team::find($id);
        View::make('/suunnitelmat/edit_team.html', array('attributes' => $team));
    }
    
    public static function update($id) {
        $params = $_POST;
        $attributes = array('name' => $params['name'], 'ground' => $params['ground']);
        $team = new Team($attributes);
        
        $errors = $team->errors();
        
        if (count($errors) > 0) {
            View::make('suunnitelmat/edit_team.html', $errors, $attributes);
            
        } else {
            $team->update($id);
            Redirect::to('/suunnitelmat/joukkueet/' . $id, array('message' => 'Joukkuetta muokattu.'));
        }
    }
    
    public static function destroy($id) {
        Team::destroy($id);
        Redirect::to('/suunntelmat/joukkueet/', array('message' => 'Joukkue on poistettu onnistuneesti.'));
    }
}
