<?php
    $title = 'Editar Licitação';
    include '../config/session.php';
    include '../partials/header.php';

    if (isset($_GET['id'])){
      $id = $_GET['id'];
      $t = $_GET['file'];
    }
?>
<div class="box">
  <h3>Editar licitação:</h3>
  <form action='edit.php' method='post'>
    <label for="title">Nome do arquivo</label>
    <input type='text' value='<?php echo $t; ?>' name='title' >
    <input type='hidden' value='<?php echo $id; ?>' name='id'>
    <div class="actions"><input type='submit' value='Editar'> </div>
  </form>
</div>

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