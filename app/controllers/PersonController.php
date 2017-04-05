<?php

class UserController extends BaseController {
    
    public static function login() {
        View::make('/suunnitelmat/login.html');
    }
    
    public static function handle_login() {
        $params = $_POST;
        
        $person = array();
        
        if (user == null) {
            View::make('/suunnitelmat/login.html', array('error' => 'Et ole olemassa.',
                'username' => $params['username']));
        }
    }
}
