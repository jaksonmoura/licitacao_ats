	<?php
    $title = 'Lista de Downloads';
		include '../partials/header.php';
    // echo $USER = hash('sha512', '12qwaszx');
    $f = $_GET['file'];
	  $list = $link->query("SELECT * FROM downloads as d WHERE d.file_id = $f order by d.updated_at ASC;");
    ?>
    <?php if ($list->num_rows > 0): ?>
    <table class='treport'>
      <thead>
        <tr>
          <th>CNPJ/CPF</th>
          <th>Data de envio</th>
        </tr>
      </thead>
      <tbody>

        <?php 
          while ($f = mysqli_fetch_assoc($list)){
            echo '<tr>';
            echo "<td> ". $f['cpf_cnpj']."</td>";
            echo "<td>".strftime('%d/%m/%Y %H:%M:%S', strtotime($f['updated_at']))."</td>";
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