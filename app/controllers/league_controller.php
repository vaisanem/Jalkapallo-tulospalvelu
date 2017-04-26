<?php

class LeagueController extends BaseController {
    
    public static function index() {
        $leagues = League::all();
        View::make('league/leagues.html', array('leagues' => $leagues));
    }
    
    public static function find($id) {
        $league = League::find($id);
        View::make('league/league.html', array('league' => $league));
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

