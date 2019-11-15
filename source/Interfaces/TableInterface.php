<?php

  interface TableInterface {
    
    public static function find($mixed);
    
    public static function where(array $paramters);
    
    public static function all();
    
    public function save();
    
    public function delete();
    
  }