<?php

//Create singleton PDO object

//$pdo = new PDO('sqlite:./data/db.sqlite');

class Database
{
  private static ?PDO $pdo = null;

  public static function getPDO(): PDO
  {
    if (self::$pdo === null) {
      self::$pdo = new PDO('sqlite:./data/db.sqlite');
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //fetch associative array
      self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    return self::$pdo;
  }
}
