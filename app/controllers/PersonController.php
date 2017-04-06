<?php

class PersonController extends BaseController {
    
    public static function login() {
        View::make('/suunnitelmat/login.html');
    }
    
    public static function handle_login() {
        $params = $_POST;
        
        $person = Person::authenticate($params['name'], $params['password']);
        
        if ($person == null) {
            View::make('/suunnitelmat/login.html', array('error' => 'Yritä uudelleen.',
                'name' => $params['name']));
        } else {
            $_SESSION['person'] = $person->id;
            
            Redirect::to('/', array('message' => 'Tervetuloa ' . $person->name . '!'));
        }
    }
}
