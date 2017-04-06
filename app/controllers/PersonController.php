<?php

class PersonController extends BaseController {
    
    public static function login() {
        View::make('/suunnitelmat/login.html');
    }
    
    public static function handle_login() {
        $params = $_POST;
        
        $person = Person::authenticate($params['username'], $params['password']);
        
        if (user == null) {
            View::make('/suunnitelmat/login.html', array('error' => 'Et ole olemassa.',
                'username' => $params['username']));
        } else {
            $_SESSION['person'] = $person->id;
            
            Redirect::to('/', array('message' => 'Tervetuloa ' . $person->name . '!'));
        }
    }
}
