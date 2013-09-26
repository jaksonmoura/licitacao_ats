<!DOCTYPE html>
<html>
<head>
    <?php 
      include_once '../partials/before_actions.php';
      $file = $_GET['file'];
    ?>
  <meta charset="utf-8">
  <script src="../assets/js/jquery.js"></script>
  <script src="../assets/js/jquery.maskedinput.js"></script>
  <link rel="stylesheet" href="../assets/css/style.css"/>
  <title>Verificação - Licitação - ATS</title>
  <script>
    $(document).ready(function(){
      $("#cpf").hide();
      $("#cnpj").focus()
      $("#cpf").mask("999.999.999-99");
      $("#cnpj").mask("99.999.999/9999-99");
      $("input[name$='pessoa']").click(function() {
          var test = $(this).val();
        $("#cpf").hide();
        $("#cnpj").hide();
            $("#"+test).show();
        $("#"+test).focus()
        }); 
    });
  </script>
</head>
<body>
  <header>
    <div class="logo"><a href="/licitacao/file/list.php"><img src="../assets/img/logo.png" alt="ATS" title='Licitação - ATS'/></a></div>
    <nav class="s_links">
      <ul>
        <li><a href="/licitacao/file/list.php">Licitações</a></li>
        <?php if (LOGGED): ?>
          <li class="send_file"><a href="/licitacao/file/new.php">Enviar arquivo <img src="../assets/img/upload.png" alt=""></a></li>
        <?php endif ?>
      </ul>
    </nav>
    <nav class="user_session">
      <ul>
        <?php if (LOGGED): ?>
        <li><a href="/licitacao/session/logout.php">Sair</a></li>
        <?php else: ?>
        <li><a href="/licitacao/session/login.php">Entrar</a></li>
        <?php endif ?>
      </ul>
    </nav>
  </header>
  <div class="wrapper">
  <form class='box' name="form1" method="post" action="download.php">
    <h3>Entre com o CPF/CNPJ:</h3>
    <input type = 'radio' name ='pessoa' value= 'cnpj' checked > <label for="pessoa">Pessoa Jurídica</label>
    <input type = 'radio' name ='pessoa' value= 'cpf'> <label for="pessoa">Pessoa Física</label>
    <br/>
    <input name="cpf" type="text" id="cpf"/>
    <input name="cnpj" type="text" id="cnpj"/>
    <input type="hidden" name="file" value="<?php echo $file; ?>">

    <div class="actions"><input type = "submit" name = "Baixar arquivo" value = "ok"></div>
  </form>
<?php include '../partials/footer.php'; ?>