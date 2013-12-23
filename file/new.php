<?php
include_once '../config/session.php';
include_once '../partials/before_actions.php';
include_once '../partials/header.php';
?>
</head>
<body>
  <div class="box">
    <h2><?php echo $_GET['l']; ?></h2>
    <h3>Enviar arquivo:</h3>
    <form action="uploader.php" id="uploader" enctype="multipart/form-data" method="post" >
      <div class="field">
        <label>Nome do arquivo</label>
        <input type="text" name="title" id="title" required/>
        <input type="hidden" name="directory_id" value="<?php echo $_GET['did'] ?>"/>
      </div>
      <div class="field">
        <label>Escolha um arquivo</label>
        <input type="file" name="name" id="name" required/>
      </div>
      <div class="actions"><input type="submit" value='Enviar'></div>
    </form>
  </div>
<?php include_once '../partials/footer.php'; ?>