<?php

use model\Cats;
use model\Product;

define("__SITE_DIR__", __DIR__);

require_once 'config/config.php';
require_once 'classes/autoload.php';

$products = Product::me()->selectAll();
$cats = Cats::me()->selectAll();



require_once 'templates/index.php';

