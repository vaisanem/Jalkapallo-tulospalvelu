<?php

class LeagueTeam extends BaseModel {
    
    public $team, $played, $wins, $draws, $losses, $scored, $conceded, $difference, $points;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public function sort($a, $b) {
        if ($a instanceof LeagueTeam && $b instanceof LeagueTeam) {
            if ($a->points > $b->points) {
                return -1;
            } elseif ($a->points < $b->points) {
                return 1;
            } elseif ($a->difference > $b->difference) {
                return -1;
            } elseif ($a->difference < $b->difference) {
                return 1;
            } elseif ($a->scored > $b->scored) {
                return -1;
            } elseif ($a->scored < $b->scored) {
                return 1;
            } elseif ($a->played > $b->played) {
                return 1;
            } elseif ($a->played < $b->played) {
                return -1;
            } else {
                return 0;
            }
        }
    }
}
