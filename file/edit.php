	<?php
    $title = 'Editar Licitação';
    include '../session.php';
    include '../messages.php';
    include '../partials/header.php';

    if (isset($_GET['edit'])){
      $id = $_GET['edit'];
      $title = $_GET['title'];
    }

?>

  <form action='edit.php' method='post'>
    <input type='text' value='<?php echo $title; ?>' name='title' >
    <input type='hidden' value='<?php echo $id; ?>' name='id'>
    <input type='submit' value='ok' name='ok'> 
  </form>

<?php

    if (isset($_POST['title'])){
      $title = $_POST['title'];
      $id = $_POST['id'];
  	  $link->query("UPDATE licitacao.files SET title='".$title."' WHERE id= ".$id);
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