<!--
  Desenvolvedores: Jakson Rochelly
                   Alan Diêgo
-->
<!doctype html>
 <html>
   <head>
    <?php
    include_once 'before_actions.php';
    header('Content-Type: text/html; charset=utf8'); ?>
    <?php if (isset($title)): ?>
     <title><?php echo $title; ?> - Licitações - ATS</title>
    <?php else: ?>
     <title>Licitações - ATS</title>
    <?php endif ?>
     <script src="../assets/js/jquery.js"></script>
     <script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
     <link rel="stylesheet" href="../assets/css/style.css"/>
     <link rel="stylesheet" href="../assets/css/jquery-ui-1.10.3.custom.min.css"/>
     <script>
       $(function() {
         $( "#datepicker" ).datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy-mm-dd',
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
    });
       });
       </script>
   </head>
   <body>
      <?php
      if (isset($_SESSION['message']) and strlen($_SESSION['message']) > 0) : ?>

          <div class="notice">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
             ?>
          </div>
      <?php endif ?>
    <header>
      <div class="logo"><a href="/licitacao/dir/list.php"><img src="../assets/img/logo.png" alt="ATS" title='Licitação - ATS'/></a></div>
      <nav class="s_links">
        <ul>
          <li><a href="/licitacao/dir/search.php">Buscar Licitação</a></li>
          <?php if (LOGGED): ?>
            <li><a href="/licitacao/dir/list_all.php">Todas as Licitação</a></li>
            <li class="send_file"><a href="/licitacao/dir/new.php">Nova Licitação</a></li>
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
      <div class="main_content">
      <div class="container">