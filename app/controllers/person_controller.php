<?php

class PersonController extends BaseController {
    
    public static function login() {
        View::make('person/login.html');
    }
    
    public static function handle_login() {
        $params = $_POST;
        
        $person = Person::authenticate($params['name'], $params['password']);
        
        if ($person == null) {
            $errors = array('error' => 'Yritä uudelleen.');
            View::make('person/login.html', array('errors' => $errors,
                'name' => $params['name']));
        } else {
            $_SESSION['person'] = $person->id;
            
            Redirect::to('/', array('message' => 'Tervetuloa ' . $person->name . '!'));
        }
    }
    
    public static function logout() {
        $_SESSION['person'] = null;
        Redirect::to('/', array('message' => 'Olet kirjautunut ulos.'));
    }
    
    public static function register() {
        View::make('person/register.html');
    }
    
    public static function handle_register() {
        $params = $_POST;
        
        $attributes = array('name' => $params['name'], 'password' => $params['password']);
        $person = new Person($attributes);
        
        $errors = $person->errors();
        
        if (count($errors) > 0) {
            View::make('person/register.html', array('errors' => $errors, 'attributes' => $attributes));
            
        } else {
            $person->register();
            Redirect::to('/', array('message' => 'Sinut on rekisteröity. Ylläpitäjä antaa sinulle muokkausoikeudet piakkoin, ehkä.'));
        }
    }
    
    public static function settings() {
        self::check_logged_in();
        $persons = Person::all();
        View::make('person/settings.html', array('persons' => $persons));
    }
    
    public static function give_rights($id) {
        $person = Person::find($id);
        $rights = 1;
        $person->rights($rights);
        Redirect::to('/asetukset', array('message' => 'Oikeudet annettu.'));
    }
    
    public static function take_rights($id) {
        $person = Person::find($id);
        $rights = 0;
        $person->rights($rights);
        Redirect::to('/asetukset', array('message' => 'Oikeudet poistettu.'));
    }
    
}

