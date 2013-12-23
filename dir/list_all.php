  <?php
    $title = 'Todas as licitações';
    include '../partials/header.php';
    include '../config/session.php';
    if (isset($_GET['date'])) {
        $date = $_GET['date'];
        $list = $link->query("SELECT * from directories where month(created_at) = month('$date') and year(created_at) = year('$date') order by created_at ASC;");
    } else {
      $list = $link->query("SELECT * from directories where month(created_at) = month('".date('Y-m-d')."') order by created_at ASC;");
    }
    $months = Array( '01' => 'Jan', '02' => 'Fev', '03' => 'Mar', '04' => 'Abr', '05' => 'Mai', '06' => 'Jun', '07' => 'Jul', '08' => 'Ago', '09' => 'Set', '10' => 'Out', '11' => 'Nov', '12' => 'Dez');
    $months_n =Array( 'Jan' => '01','Fev' => '02','Mar' => '03','Abr' => '04','Mai' => '05','Jun' => '06','Jul' => '07','Ago' => '08','Set' => '09','Out' => '10','Nov' => '11','Dez' => '12');
  ?>
  <div class="filter">
    <ul class="months">
      <span>Filtrar por mês:</span>
    <?php foreach ($months as $month): ?>
        <?php
        $date = date('Y').'-'.$months_n[$month].'-'.'01';
        $result = $link->query("select count(*) as count from directories where month(created_at) = month('$date')");
        $qtdelt = mysqli_fetch_assoc($result);
        ?>
        <li><a href="list_all.php?date=<?php echo $date ?>"><?php echo $month.' ('.$qtdelt['count'].')'; ?></a></li>
    <?php endforeach ?>
    </ul>
    <form class="filter_form" action="list.php" method="get">
      <input type="text" name="date" id="datepicker">
      <div class="actions">
        <input type="submit" value="Filtrar">
      </div>
    </form>
  </div>
  <?php if ($list->num_rows > 0): ?>
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
  <?php else: ?>
    <div class="noresult">Nenhum registro foi encontrado!</div>
  <?php endif ?>
<?php
include '../partials/footer.php';
 ?>