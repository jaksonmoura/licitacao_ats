    <?php
      include '../partials/header.php';
      if (strlen($_GET['year']) > 0 && strlen($_GET['month']) > 0) {
          $year = $_GET['year'];
          $month = $_GET['month'];
          $list = $link->query("SELECT * from directories where month(created_at) = $month and year(created_at) = $year order by created_at ASC;");
      } else {
        $_SESSION['message'] = 'Por favor, selecione ao menos o ANO e MÊS nas opções de busca';
        header('location: search.php');
      }
    ?>
      <h3><?php
        echo "Licitações referente à $month/$year ";
      ?>
      </h3>
      <table>
        <thead>
          <tr>
            <th class='tfile'>Licitação</th>
            <th class='tdate'>Data de envio</th>
            <th class="tactions">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
            while ($d = mysqli_fetch_assoc($list)){
              echo '<tr>';
              echo "<td><a href='show.php?id=".$d['id']."'>".$d['name']."</a></td>";
              echo "<td>".strftime('%d/%m/%Y', strtotime($d['created_at']))."</td>";
              echo '<td>';
              if (LOGGED) {
                $url = $_SERVER['REQUEST_URI'];
                echo '
                      <a href="edit.php?id='.$d['id'].'&file='.$d['name'].'&redirects_to='.$url.'"><img src="../assets/img/edit.png" alt="Editar" title="Editar"></a>
                      <form class="fremove" action="remove.php" method="post">
                        <input class="iremove" type="submit" value="Remover" title="Remover">
                        <input type="hidden" name="file" value='.$d['id'].'>
                        <input type="hidden" name="name" value='.$d['name'].'>
                        <input type="hidden" name="redirects_to" value='.$url.'>
                      </form>';
                echo "<a href='/licitacao/file/new.php?did=".$d['id']."&l=".$d['name']."'><img src='../assets/img/upload2.png'></a>";
              }
              echo '</td>';
              echo '</tr>';
            }
          ?>
        </tbody>
      </table>
  <?php
  include '../partials/footer.php';
   ?>