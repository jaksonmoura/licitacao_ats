<?php
session_start(); 
if (!$_SESSION['logged']) { 
    // $url = $_SERVER['REQUEST_URI'];
    // header("Location: /licitacao/session/login.php?redirects_to=$url");
    header("Location: /licitacao/session/login.php");
    exit; 
}
 ?>