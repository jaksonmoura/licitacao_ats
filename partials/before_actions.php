<?php 
ini_set('display_errors', 'On');
error_reporting(E_ALL);
session_start();
$ROOT = '/'.basename(__DIR__);
define('LOGGED', $_SESSION['logged']);
include_once '../config/connection.php';
 ?>