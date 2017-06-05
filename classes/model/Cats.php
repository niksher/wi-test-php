<?php

namespace model;

use PDO;

/**
 * Description of Cats
 *
 * @author nikit
 */
class Cats
{
  public function __construct()
  {
  }


  public static function me()
  {
    return new Cats();
  }
  
  public function selectAll()
  {
    $dsn = "mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, MYSQL_USER, MYSQL_PASS, $opt);

    $sel = $pdo->query(<<<_____
        SELECT
          id
          , name
        FROM category
_____
        );

    return $sel->fetchAll();
  }
}
