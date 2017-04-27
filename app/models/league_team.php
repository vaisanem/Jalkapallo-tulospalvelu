<?php

class LeagueTeam extends BaseModel {
    
    public $team, $played, $wins, $draws, $losses, $scored, $conceded, $difference, $points;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function find($id) {
        
    }
}
