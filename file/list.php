	<?php
    $title = 'Lista de arquivos';
		include '../partials/header.php';
    if (isset($_GET['date'])) {
        $date = $_GET['date'];
        $list = $link->query("SELECT * from files where month(created_at) = month('$date') and year(created_at) = year('$date') order by created_at ASC;");
    } else {
		  $list = $link->query("SELECT * from files where month(created_at) = month('".date('Y-m-d')."') order by created_at ASC;");
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
        $result = $link->query("select count(*) as count  from files where month(created_at) = month('$date')"); 
        $qtdelt = mysqli_fetch_assoc($result);
        ?>
        <?php if ($qtdelt['count'] == 0): ?>
        <li class="no_lic"><a href="#"><?php echo $month.' ('.$qtdelt['count'].')'; ?></a></li>      
        <?php else: ?>
        <li><a href="list.php?date=<?php echo $date; ?>"><?php echo $month.' ('.$qtdelt['count'].')'; ?></a></li>   
       <?php endif ?>
    <?php endforeach ?>
    </ul>
    <form class="filter_form" action="list.php" method="get">
      <input type="text" name="date" id="datepicker">
      <div class="actions">
        <input type="submit" value="Filtrar">
      </div>
    </form>
  </div>
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
            echo "<td>".$f['created_at']."</td>";
            echo '<td>';
            if (LOGGED) {
              echo '
                    <a href="edit.php?id='.$f['id'].'&file='.$f['title'].'"><img src="../assets/img/edit.png" alt="Editar" title="Editar"></a>
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