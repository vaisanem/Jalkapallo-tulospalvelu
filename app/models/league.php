<?php

class League extends BaseModel {
    
    public $id, $name;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function all() {
        
    }
    
}
