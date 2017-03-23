<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
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
  }
