  <?php
    $title = 'Remover licitação';
    include '../config/session.php';
    include '../partials/header.php';
    if (isset($_POST['file'])){
      $d = $_POST['file'];
      $file_name = $_POST['name'];
      $link->query("DELETE FROM licitacao.directories WHERE id = ".$d);
      if ($link->affected_rows>0) {
        unlink("../assets/pdf/".$file_name);
        $_SESSION['message'] = "Removido com sucesso";
      } else {
        $_SESSION['message'] = "Não foi possível remover, tente novamente";
      }
    } else {
      $_SESSION['message'] = "Não foi possível remover, tente novamente";
    }
    $url = $_POST['redirects_to'];
    header("location: $url");
    ?>
<?php
include '../partials/footer.php';
 ?>