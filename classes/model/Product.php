<?php

namespace model;

use PDO;

/**
 * Description of Product
 *
 * @author nikit
 */
class Product
{
  public function __construct()
  {
  }


  public static function me()
  {
    return new Product();
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
          p.id
          , p.name 
          , p.price
          , c.name as cat
        FROM product as p
        LEFT JOIN category as c
          ON(c.id = p.cat_id)
        ORDER BY p.id
_____
        );

    return $sel->fetchAll();
  }
  
  public function selectById($id)
  {
    $dsn = "mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, MYSQL_USER, MYSQL_PASS, $opt);

    $sel = $pdo->prepare(<<<_____
        SELECT 
          p.id
          , p.name 
          , p.price
          , p.cat_id
          , c.name as cat
        FROM product as p
        LEFT JOIN category as c
          ON(c.id = p.cat_id)
        WHERE p.id=:id
_____
        );
    
    $sel->execute(["id" => $id]);
    return $sel->fetch();
  }
  
  public function update($id, $name, $price, $cat)
  {
    $dsn = "mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, MYSQL_USER, MYSQL_PASS, $opt);

    $sel = $pdo->prepare(<<<_____
        UPDATE product SET
          name=:name 
          , price=:price
          , cat_id=:cat
        WHERE id=:id
_____
        );
    
    $sel->execute([
        "id" => $id
        , "name" => $name
        , "price" => $price
        , "cat" => $cat
        ]);
    
    return $this->selectById($id);
  }
  
  public function add($name, $price, $cat)
  {
    $dsn = "mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, MYSQL_USER, MYSQL_PASS, $opt);

    $sel = $pdo->prepare(<<<_____
        INSERT INTO 
          product 
        SET 
          cat_id=1
_____
        );
    
    $sel->execute([]);
    
    $id = $pdo->lastInsertId();
        
    return $this->update($id, $name, $price, $cat);
  }
  
  public function delete($id)
  {
    $dsn = "mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, MYSQL_USER, MYSQL_PASS, $opt);

    $sel = $pdo->prepare(<<<_____
        DELETE FROM
          product 
        WHERE 
          id=:id
_____
        );
    
    $sel->execute([
        "id" => $id
    ]);
        
    return ["id" => $id];
  }
}
