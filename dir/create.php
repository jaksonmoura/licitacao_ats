<?php
include_once '../partials/header.php';
include_once '../config/session.php';
 ?>
<div class="box tcenter">
<?php
        $name = $_POST['name'];
        $link->query("INSERT INTO directories (name) VALUES ('$name')");
        $_SESSION['message'] = 'Diretório criado com sucesso!';
        header('location: ../file/new.php');
?>
</div>