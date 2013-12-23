<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
$ROOT = '/'.basename(__DIR__);
define('LOGGED', $_SESSION['logged']);
include_once '../config/connection.php';
$link->query('SET NAMES utf8;');
?>