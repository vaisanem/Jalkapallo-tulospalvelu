<?php

  class BaseController{

    public static function get_user_logged_in(){
        if (isset($_SESSION['person'])) {
            $id = $_SESSION['person'];
            $person = Person::find($id);
            return $person;
        }
        return null;
    }

    public static function check_logged_in(){
        if (!isset($_SESSION['person'])) {
            Redirect::to('suunnitelmat/kirjaudu', array('message' => 'Sinun on kirjauduttava ensin.'));
        }
    }

  }
