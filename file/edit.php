<?php
    $title = 'Editar Licitação';
    include '../config/session.php';
    include '../partials/header.php';

    if (isset($_GET['id'])){
      $id = $_GET['id'];
      $result = $link->query("select * from files where id = $id;");
      $file = mysqli_fetch_assoc($result);
    }
?>
<div class="box">
  <h3>Editar licitação:</h3>
  <form action='edit.php' method='post'>
    <div class="field">
      <label for="title">Nome do arquivo</label>
      <input type='text' value='<?php echo $file['title']; ?>' name='title' required>
    </div>
    <div class="field">
      <label for="category_id">Categoria</label>
      <select name="category_id" required>
        <?php 
          $result = $link->query('select * from categories;');
          while ($r = mysqli_fetch_assoc($result)) {
            if (condition) {
              echo '<option value="'.$r['id'].'" selected>'.$r['name'].'</option>';
            } else {
              echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
            }
          }
         ?>
      </select>
    </div>
    <input type='hidden' value='<?php echo $file['id']; ?>' name='id'>
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