<?php 
error_reporting(0);
session_start();
$ROOT = '/'.basename(__DIR__);
define('LOGGED', $_SESSION['logged']);
include_once '../config/connection.php';
 ?>