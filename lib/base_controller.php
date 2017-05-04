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
            Redirect::to('/kirjaudu', array('message' => 'Sinun on kirjauduttava ensin.'));
        } else {
            $person = self::get_user_logged_in();
            if ($person->mode == 0) {
                Redirect::to('/asetukset', array('message' => 'Sinulla ei ole muokkausoikeuksia.'));
            }
        }
    }

  }
