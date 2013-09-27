    <?php
      $title = 'Lista de arquivos';
      include '../partials/header.php';
      if (strlen($_GET['year']) > 0 && strlen($_GET['month']) > 0) {
          $year = $_GET['year'];
          $month = $_GET['month'];
          $category = $_GET['category'];
          if (strlen($category) > 0) {
            $list = $link->query("SELECT * from files where month(created_at) = $month and year(created_at) = $year and category_id = $category order by created_at ASC;");
          } else {
            $list = $link->query("SELECT * from files where month(created_at) = $month and year(created_at) = $year order by created_at ASC;");
          }
      } else {
        $_SESSION['message'] = 'Por favor, selecione ao menos o ANO e MÊS nas opções de busca';
        header('location: search.php');
      }
    ?>
      <?php $result = $link->query("select * from categories where id= $category");
        $c = mysqli_fetch_assoc($result);
        $c = $c['name'];
       ?>
      <h3><?php echo "$c referentes à $month/$year "; ?></h3>
      <table>
        <thead>
          <tr>
            <th class='tfile'>Arquivo</th>
            <th class='tdate'>Data de envio</th>
            <th class="tactions">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            while ($f = mysqli_fetch_assoc($list)){
              echo '<tr>';
              echo "<td><a href='form.php?file=".$f['name']."'>".$f['title']."</a></td>";
              echo "<td>".strftime('%d/%m/%Y', strtotime($f['created_at']))."</td>";
              echo '<td>';
              if (LOGGED) {
                echo '
                      <a href="edit.php?id='.$f['id'].'"><img src="../assets/img/edit.png" alt="Editar" title="Editar"></a>
                      <form class="fremove" action="remove.php" method="post">
                        <input class="iremove" type="submit" value="Remover" title="Remover">
                        <input type="hidden" name="file" value='.$f['id'].'>
                        <input type="hidden" name="name" value='.$f['name'].'>
                      </form>
                      <a href="report.php?file='.$f['id'].'"><img src="../assets/img/report.png" alt="Relarório" title="Relarório"></a>';
              }
              echo "<a href='form.php?file=".$f['name']."'><img src='../assets/img/save.png' alt='Baixar arquivo' title='Baixar arquivo'></a>";
              echo '</td>';
              echo '</tr>';
            }
          ?>
        </tbody>
      </table>
  <?php 
  include '../partials/footer.php';
   ?>