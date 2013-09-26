<?php 
  $message = $_SESSION['message'];
  if (isset($message) and strlen($message) > 0) {
    echo $message;
    unset($_SESSION['message']);
  }
?>