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
}

