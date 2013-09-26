	<?php
    $title = 'Editar Licitação';
    include '../config/session.php';
    include '../config/messages.php';
    include '../partials/header.php';

    if (isset($_GET['edit'])){
      $id = $_GET['edit'];
      $t = $_GET['title'];
    }

?>

  <form action='edit.php' method='post'>
    <input type='text' value='<?php echo $t; ?>' name='title' >
    <input type='hidden' value='<?php echo $id; ?>' name='id'>
    <input type='submit' value='ok' name='ok'> 
  </form>

<?php

    if (isset($_POST['title'])){
      $t = $_POST['title'];
      $id = $_POST['id'];
  	  $link->query("UPDATE licitacao.files SET title='".$t."' WHERE id= ".$id);
      if ($link->affected_rows>0) {
        $_SESSION['message'] = "Editado com sucesso";
      } else {
        $_SESSION['message'] = "Não foi possível editar, tente novamente";
      }
      header("location: list.php");
    }
    ?>
<?php 
include '../partials/footer.php';
 ?>