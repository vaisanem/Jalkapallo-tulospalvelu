<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/suunnitelmat/kirjaudu', function() {
    HelloWorldController::login();
  });
  
  $routes->get('/suunnitelmat/rekisteroidy', function() {
    HelloWorldController::register();
  });
  
  $routes->get('/suunnitelmat/sarjat', function() {
    HelloWorldController::leagues();
  });
  
  $routes->get('/suunnitelmat/joukkueet', function() {
    TeamController::index();
  });
  
  $routes->post('/suunnitelmat/joukkueet', function() {
    TeamController::store();
  });
  
  $routes->get('/suunnitelmat/sarjat/1', function() {
    HelloWorldController::league();
  });
  
  $routes->get('/suunnitelmat/joukkueet/lisaa', function() {
      TeamController::create();
  });
  
  $routes->get('/suunnitelmat/joukkueet/:id/muokkaa', function($id) {
    HelloWorldController::editTeam($id);
  });
  
  $routes->get('/suunnitelmat/joukkueet/:id', function($id) {
      TeamController::find($id);
  });
  
  
  $routes->get('/suunnitelmat/sarjat/muokkaa', function() {
    HelloWorldController::editLeague();
  });
