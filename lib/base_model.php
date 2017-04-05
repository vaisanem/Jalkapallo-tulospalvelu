<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();
      $another = array();
      

      foreach($this->validators as $validator){
          $another = $this->{$validator}();
          $errors = array_merge($errors, $another);
      }

      return $errors;
    }
    
    public function validate_string_length($string) {
        $errors = array();
        if ($string == '' || $string == null) {
            $errors[] = 'Nimi ei saa olla tyhjä.';
        }
        if (strlen($string) < 3 || strlen($string) > 31) {
            $errors[] = 'Nimen pituuden oltava välillä 3-30.';
        }
        return $errors;
    }

  }
