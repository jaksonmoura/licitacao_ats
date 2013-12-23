  <?php
    $title = 'Detalhes';
    include '../partials/header.php';
    include '../config/session.php';
    $d_id = $_GET['id'];
    $list = $link->query("SELECT name from directories where id = $d_id;");
    $d = mysqli_fetch_assoc($list);
    $list = $link->query("SELECT * from files where directory_id = $d_id order by created_at ASC;");
  ?>
  <h3>Licitação <?php echo $d['name'] ?></h3>
  <div class="actions"><a href="/licitacao/file/new.php?did=<?php echo $d_id; ?>">Enviar arquivo</a></div>
  <?php if ($list->num_rows > 0): ?>
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
            echo "<td><a href='../file/form.php?file=".$f['name']."'>".$f['title']."</a></td>";
            echo "<td>".strftime('%d/%m/%Y', strtotime($f['created_at']))."</td>";
            echo '<td>';
            if (LOGGED) {
              $url = $_SERVER['REQUEST_URI'];
              echo '
                    <a href="../file/edit.php?id='.$f['id'].'&file='.$f['title'].'&redirects_to='.$url.'"><img src="../assets/img/edit.png" alt="Editar" title="Editar"></a>
                    <form class="fremove" action="../file/remove.php" method="post">
                      <input class="iremove" type="submit" value="Remover" title="Remover">
                      <input type="hidden" name="file" value='.$f['id'].'>
                      <input type="hidden" name="name" value='.$f['name'].'>
                      <input type="hidden" name="redirects_to" value='.$url.'>
                    </form>
                    <a href="../file/report.php?file='.$f['id'].'"><img src="../assets/img/report.png" alt="Relarório" title="Relarório"></a>';
            }
            echo "<a href='../file/form.php?file=".$f['name']."'><img src='../assets/img/save.png' alt='Baixar arquivo' title='Baixar arquivo'></a>";
            echo '</td>';
            echo '</tr>';
          }
        ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="noresult">Nenhum registro foi encontrado!</div>
  <?php endif ?>
<?php
include '../partials/footer.php';
 ?>