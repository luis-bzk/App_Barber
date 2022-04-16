<?php
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require 'database.php';


// conection database
use Model\ActiveRecord;

$db = conectarDB();
ActiveRecord::setDB($db);