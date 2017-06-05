<?php

use model\Product;

require_once 'config/config.php';
require_once 'classes/autoload.php';
define("__SITE_DIR__", __DIR__);

$act = $_POST["action"];

if ($act == "sel") {
  
  if (isset($_POST["id"])) {
    $product = Product::me()->selectById((int)$_POST["id"]);
    
    echo json_encode($product);
  }
  
}

if ($act == "update") {
  
  if (isset($_POST["id"])) {
    $product = Product::me()->update((int)$_POST["id"], $_POST["name"], (float)$_POST["price"], (int)$_POST["cat"]);
    
    echo json_encode($product);
  }
  
}

if ($act == "add") {
    $product = Product::me()->add($_POST["name"], (float)$_POST["price"], (int)$_POST["cat"]);
    
    echo json_encode($product); 
}

if ($act == "delete") {
    $product = Product::me()->delete((int)$_POST["id"]);
    
    echo json_encode($product); 
}

