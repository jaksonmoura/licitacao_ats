<?php
session_start(); 
if (!$_SESSION['logged']) { 
    header("Location: /licitacao/session/login.php");
    exit; 
}
 ?>