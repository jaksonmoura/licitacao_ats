<?php 
$title = "Login";
include '../partials/header.php';
 ?>
    <form class='box' action="verify.php" method="post">
        <h3>Entrar no sistema:</h3>
        Usuário:<br>
        <input type="text" name="username" autofocus><br>
        Senha:<br>
        <input type="password" name="password"><br>
        <div class="actions">
          <input type="submit" name="submit" value="Login">
        </div>
    </form>
<?php 
include '../partials/footer.php';
 ?>