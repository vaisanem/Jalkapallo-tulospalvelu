<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/kirjaudu', function() {
    PersonController::login();
  });
  
  $routes->post('/kirjaudu', function() {
    PersonController::handle_login();
  });
  
  $routes->post('/kirjaudu/ulos', function() {
    PersonController::logout();
  });
  
  $routes->get('/rekisteroidy', function() {
      PersonController::register();
  });
  
  $routes->post('/rekisteroidy', function() {
      PersonController::handle_register();
  });
  
  $routes->get('/asetukset', function() {
      PersonController::settings();
  });
  
  $routes->post('/oikeudet/:id/anna', function($id) {
      PersonController::give_rights($id);
  });
  
  $routes->post('/oikeudet/:id/poista', function($id) {
      PersonController::take_rights($id);
  });
  
  $routes->get('/sarjat', function() {
      LeagueController::index();
  });
  
  $routes->post('/sarjat', function() {
      LeagueController::store();
  });
  
  $routes->get('/sarjat/lisaa', function() {
      LeagueController::create();
  });
  
  $routes->get('/sarjat/:id/muokkaa', function($id) {
      LeagueController::edit($id);
  });
  
  $routes->post('/sarjat/:id/muokkaa', function($id) {
      LeagueController::update($id);
  });
  
  $routes->post('/sarjat/:id/poista', function($id) {
      LeagueController::destroy($id);
  });
  
  $routes->get('/sarjat/:id/ottelut', function($id) {
      GameController::leagues_games($id);
  });
  
  $routes->get('/sarjat/:id/ottelut/lisaa', function($id) {
      LeagueController::add_game($id);
  });
  
  $routes->post('/sarjat/:id/ottelut/lisaa', function($id) {
      LeagueController::store_game($id);
  });
  
  $routes->get('/sarjat/:id', function($id) {
      LeagueController::find($id);
  });
  
  $routes->get('/joukkueet', function() {
    TeamController::index();
  });
  
  $routes->post('/joukkueet', function() {
    TeamController::store();
  });
  
  $routes->get('/joukkueet/lisaa', function() {
    TeamController::create();
  });
  
  $routes->get('/joukkueet/:id/muokkaa', function($id) {
    TeamController::edit($id);
  });
  
  $routes->post('/joukkueet/:id/muokkaa', function($id) {
    TeamController::update($id);
  });
  
  $routes->get('/joukkueet/:id/ottelut', function($id) {
      GameController::teams_games($id);
  });
  
  $routes->post('/joukkueet/:id/poista', function($id) {
    TeamController::destroy($id);
  });
  
  $routes->post('/joukkueet/:id/lisaa/sarjaan', function($id) {
    TeamController::add_to_league($id);
  });
  
  $routes->get('/joukkueet/:id', function($id) {
    TeamController::find($id);
  });
  
