<?php

  class Database {
    
    public static $connection = NULL;
    public static $settings = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false
    );

    public static function connection() {
      require_once dirname(__DIR__, 2).'/config/dbconfig.php';
      
      if (empty(static::$connection)) {
        static::$connection = new PDO("mysql:host=".$localdb['host'].";dbname=".$localdb['database'].";",$localdb['username'], $localdb['password'], self::$settings);
      }
      
    }
    
    public static function query($sql, $params) {
      static::connection();
      $stmt = static::$connection->prepare($sql);
      $stmt->execute($params);
      return $stmt->rowCount();
    }

    public static function find($sql, $params = array()) {
      static::connection();
      $stmt = static::$connection->prepare($sql);
      $stmt->execute($params);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findAll($sql, $params = array()) {
      static::connection();
      $stmt = static::$connection->prepare($sql);
      $stmt->execute($params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert($table, $params = array()) {
      static::connection();
      $sql = "INSERT INTO `".$table."` (`".implode('`, `', array_keys($params))."`) VALUES (".str_repeat('?, ', sizeof($params)-1)." ?)";
      $stmt = static::$connection->prepare($sql);
      $stmt->execute(array_values($params));
      return $stmt->rowCount();
    }

    public static function update($table, $values = array(), $condition, $params = array()) {
      static::connection();
      $sql = "UPDATE `$table` SET `".implode('` = ?, `', array_keys($values))."`= ? ".$condition;
      $stmt = static::$connection->prepare($sql);
      $stmt->execute(array_merge(array_values($values), $params));
      return $stmt->rowCount();
    }

    public static function delete($table, $params = array()) {
      static::connection();
      $sql = "DELETE FROM `".$table."` WHERE `".implode('` = ? AND `', array_keys($params))."` = ? ";
      $stmt = static::$connection->prepare($sql);
      $stmt->execute(array_values($params));
      return $stmt->rowCount();
    }

  }
