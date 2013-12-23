<?php
include_once '../config/session.php';
include_once '../partials/before_actions.php';
include_once '../partials/header.php';
?>
</head>
<body>
  <div class="box">
    <h3>Criar diretório:</h3>
    <form action="create.php" id="uploader" enctype="multipart/form-data" method="post" >
      <div class="field">
        <label>Nome do diretório</label>
        <input type="text" name="name" id="name" required/>
      </div>
      <div class="actions"><input type="submit" value='Enviar'></div>
    </form>
  </div>
<?php include_once '../partials/footer.php'; ?>