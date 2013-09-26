	<?php
    $title = 'Lista de Downloads';
		include '../partials/header.php';
    // echo $USER = hash('sha512', '12qwaszx');
    $f = $_GET['file'];
	$list = $link->query("SELECT * FROM downloads as d WHERE d.file_id = $f order by d.updated_at ASC;");
    ?>
    <table>
      <thead>
        <tr>
          <th class='tfile'>CNPJ/CPF</th>
          <th class='tdate'>Data de envio</th>
          <th class="tactions">Ações</th>
        </tr>
      </thead>
      <tbody>

        <?php 
          while ($f = mysqli_fetch_assoc($list)){
            echo '<tr>';
            echo "<td> ". $f['cpf_cnpj']."</td>";
            echo "<td>".$f['updated_at']."</td>";
            echo "<td> </td>";
            echo '</tr>';
          }
        ?>
      </tbody>
    </table>
<?php 
include '../partials/footer.php';
 ?>