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
  
