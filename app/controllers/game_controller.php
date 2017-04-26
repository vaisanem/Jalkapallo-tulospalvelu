<?php

class GameController extends BaseController {
    
    public function teams_games($team_id) {
        $team = Team::find($team_id);
        $games = Game::teams_games($team_id);
        View::make('gamehistory.html', array('name' => $team->name, 'games' => $games));
    }
    
    public function leagues_games($league_id) {
        $league = League::find($league_id);
        $games = Game::leagues_games($league_id);
        View::make('gamehistory.html', array('name' => $league->name, 'games' => $games));
    }
}
