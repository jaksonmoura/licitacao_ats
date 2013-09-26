<?php
	include_once '../partials/before_actions.php';
	$file = "../assets/pdf/".$_POST['file'];
	$filename = $_POST['file'];
	//Valida CPF
	function validarCPF($cpf)
	{
			// remove os caracteres não-numéricos
			$cpf = preg_replace('/\D/', '', $cpf);
	 
			// verifica se a sequência tem 11 dígitos
			if (strlen($cpf) != 11)
					return false;
	 
			// calcula o primeiro dígito verificador 
			$sum = 0;
			for ($i = 0; $i < 9; $i++) {
					$sum += $cpf[$i] * (10-$i);
			}
			$mod = $sum % 11;
			$digit = ($mod > 1) ? (11 - $mod) : 0;
	 
			// verifica se o primeiro dígito verificador está correto
			if ($cpf[9] != $digit)
					return false;
	 
			// calcula o segundo dígito verificador
			$sum = 0;
			for ($i = 0; $i < 10; $i++) {
					$sum += $cpf[$i] * (11-$i);
			}
			$mod = $sum % 11;
			$digit = ($mod > 1) ? (11 - $mod) : 0;
	 
			// verifica se o segundo dígito verificador está correto
			if ($cpf[10] != $digit)
					return false;
	 
			// Repetir 11 vezes o mesmo número não é permitido, pois não existem CPFs com esta formação numérica.
			if (str_repeat($cpf[0],11) == $cpf) {
					return false;
			}
			// está tudo certo
			return true;
	}

	function validarCnpj($c) {  
		$b = array(6,5,4,3,2,9,8,7,6,5,4,3,2);
		if(strlen($c = preg_replace("/[^\d]/", "", $c)) != 14)
			return false;
		for ($i = 0, $n = 0; $i < 12; $n += $c[$i] * $b[++$i]);
		if($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n))
			return false;
		for ($i = 0, $n = 0; $i <= 12; $n += $c[$i] * $b[$i++]);
		if($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n))
			return false;
		return true; 
	}
		if(is_file($file)) {
			if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off');	}
			// get the file mime type using the file extension
			switch(strtolower(substr(strrchr($file, '.'), 1))) {
				case 'pdf': $mime = 'application/pdf'; break;
				case 'zip': $mime = 'application/zip'; break;
				case 'jpeg':
				case 'jpg': $mime = 'image/jpg'; break;
				default: $mime = 'application/force-download';
			}
		}

		if ($_POST['pessoa']=='cpf') {
			if(!validarCpf($_POST['cpf'])){
					header( "Location: list.php" );
				} else {
					// Fazer o download
					$cpf_cnpj = $_POST['cpf'];
					$result = $link->query("SELECT id from files where name='$filename' LIMIT 1;");
					$f = mysqli_fetch_assoc($result);
					$id = $f['id'];
					$link->query("INSERT INTO downloads (file_id, cpf_cnpj) VALUES('$id', '$cpf_cnpj')");
					header('Pragma: public'); 	// required
					header('Expires: 0');		// no cache
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Cache-Control: private',false);
					header('Content-Type: '.$mime);
					header('Content-Disposition: attachment; filename="'.basename($file).'"');
					header('Content-Length: '.filesize($file));	// provide file size
					header("Content-Transfer-Encoding: binary");
					header('Accept-Ranges: bytes');
					header('Connection: close');
					readfile($file); // push it out
					exit();
			}
		} else {
			if(!validarCnpj($_POST['cnpj'])){
					header( "Location: list.php" );
				} else {
					$cpf_cnpj = $_POST['cnpj'];
					$result = $link->query("SELECT id from files where name='$filename' LIMIT 1;");
					$f = mysqli_fetch_assoc($result);
					$id = $f['id'];
					$link->query("INSERT INTO downloads (file_id, cpf_cnpj) VALUES('$id', '$cpf_cnpj')");
					header('Pragma: public'); 	// required
					header('Expires: 0');		// no cache
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Cache-Control: private',false);
					header('Content-Type: '.$mime);
					header('Content-Disposition: attachment; filename="'.basename($file).'"');
					header('Content-Length: '.filesize($file));	// provide file size
					header("Content-Transfer-Encoding: binary");
					header('Accept-Ranges: bytes');
					header('Connection: close');
					readfile($file); // push it out
					exit();
			}
		}
?>