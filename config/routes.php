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
    HelloWorldController::teams();
  });
  
  $routes->get('/suunnitelmat/sarja', function() {
    HelloWorldController::league();
  });
  
  $routes->get('/suunnitelmat/joukkue', function() {
    HelloWorldController::team();
  });
  
  $routes->get('/suunnitelmat/joukkue_muokkaus', function() {
    HelloWorldController::editTeam();
  });
  
  $routes->get('/suunnitelmat/sarja_muokkaus', function() {
    HelloWorldController::editLeague();
  });
