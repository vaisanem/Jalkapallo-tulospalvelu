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
