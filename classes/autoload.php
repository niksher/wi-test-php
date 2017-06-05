<?php

function my_autoload ($pClassName) {
  $classPath = str_replace("\\", "/" ,__SITE_DIR__ . "/classes/" . $pClassName . ".php");
   include_once $classPath;
}
spl_autoload_register("my_autoload");

