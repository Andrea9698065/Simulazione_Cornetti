<?php

require_once "Controls/functions.php";
require_once "Model/config.php";
require_once "Model/crud.php";
require_once "Model/database.php";

$page = $_GET['page'] ?? 'negozio' ;

$db = Cdatabase::getInstance();
$db->connect();
$route = [
  'negozio'  => 'View/negozio.php',
  'aggiungi' => 'View/aggiungi.php',
   'vendi' => 'View/vendi.php',
];

RouteControl($route, $page);

