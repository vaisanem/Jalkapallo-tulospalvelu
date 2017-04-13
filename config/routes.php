<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/suunnitelmat/kirjaudu', function() {
    PersonController::login();
  });
  
  $routes->post('/suunnitelmat/kirjaudu', function() {
    PersonController::handle_login();
  });
  
  $routes->post('/suunnitelmat/kirjaudu/ulos', function() {
    PersonController::logout();
  });
  
  $routes->get('/suunnitelmat/rekisteroidy', function() {
      PersonController::register();
  });
  
  $routes->post('/suunnitelmat/rekisteroidy', function() {
      PersonController::handle_register();
  });
  
  $routes->get('/suunnitelmat/asetukset', function() {
      PersonController::settings();
  });
  
  $routes->post('/suunnitelmat/oikeudet/:id/anna', function($id) {
      PersonController::give_rights($id);
  });
  
  $routes->post('/suunnitelmat/oikeudet/:id/poista', function($id) {
      PersonController::take_rights($id);
  });
  
  $routes->get('/suunnitelmat/sarjat', function() {
      LeagueController::index();
  });
  
  $routes->get('/suunnitelmat/sarjat/:id', function($id) {
      LeagueController::find($id);
  });
  
  $routes->get('/suunnitelmat/sarjat/1/muokkaa', function() {
    HelloWorldController::editLeague();
  });
  
  $routes->get('/suunnitelmat/joukkueet', function() {
    TeamController::index();
  });
  
  $routes->post('/suunnitelmat/joukkueet', function() {
    TeamController::store();
  });
  
  $routes->get('/suunnitelmat/joukkueet/lisaa', function() {
    TeamController::create();
  });
  
  $routes->get('/suunnitelmat/joukkueet/:id/muokkaa', function($id) {
    TeamController::edit($id);
  });
  
  $routes->post('/suunnitelmat/joukkueet/:id/muokkaa', function($id) {
    TeamController::update($id);
  });
  
  $routes->post('/suunnitelmat/joukkueet/:id/poista', function($id) {
    TeamController::destroy($id);
  });
  
  $routes->get('/suunnitelmat/joukkueet/:id', function($id) {
    TeamController::find($id);
  });
  
