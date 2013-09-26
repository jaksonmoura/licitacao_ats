<?php 
session_start();
session_destroy();
header('refresh: 3; /licitacao/file/list.php');
$title = "Logout";
include '../partials/header.php';
 ?>

<div class="box">
  <h3 class="tcenter">Você saiu!</h3>
</div>

 <?php include '../partials/footer.php'; ?>

