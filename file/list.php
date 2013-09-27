	<?php
    $title = 'Lista de arquivos';
		include '../partials/header.php';
    if (isset($_GET['year']) && isset($_GET['month']) && isset($_GET['category'])) {
        $year = $_GET['year'];
        $month = $_GET['month'];
        $category = $_GET['category'];
        $list = $link->query("SELECT * from files where month(created_at) = $month and year(created_at) = $year and category_id = $category order by created_at ASC;");
    } else {
		  $_SESSION['message'] = 'Por favor, selecione as opções de busca';
      header('location: search.php');
    }
    $months = Array( '01' => 'Jan', '02' => 'Fev', '03' => 'Mar', '04' => 'Abr', '05' => 'Mai', '06' => 'Jun', '07' => 'Jul', '08' => 'Ago', '09' => 'Set', '10' => 'Out', '11' => 'Nov', '12' => 'Dez');
    $months_n =Array( 'Jan' => '01','Fev' => '02','Mar' => '03','Abr' => '04','Mai' => '05','Jun' => '06','Jul' => '07','Ago' => '08','Set' => '09','Out' => '10','Nov' => '11','Dez' => '12');
  ?>
  <div class="filter">
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
            echo "<td>".strftime('%d/%m/%Y', strtotime($f['created_at']))."</td>";
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