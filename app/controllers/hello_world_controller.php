<?php
    require 'app/models/team.php';

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html', array('message' => $_SESSION['flash_message']));
    }

    public static function sandbox(){
        $teams = Team::all();
        Kint::dump($teams);
        View::make('helloworld.html');
    }
    
    public static function login(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/login.html');
    }
    
    public static function register(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/register.html');
    }
    
    public static function leagues(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/leagues.html');
    }
    
    public static function teams(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/teams.html');
    }
    
    public static function league(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/league.html');
    }
    
    public static function team(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/team.html');
    }
    
    public static function editTeam($id){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/edit_team.html');
    }
    
    public static function editLeague(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/edit_league.html');
    }
  }
