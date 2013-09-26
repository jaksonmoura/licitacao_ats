<?php
$file = $_POST['file'];
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

	if ($_POST['pessoa']=='cpf') {
		if(!validarCpf($_POST['cpf'])){
          echo'CPF errado';
    	} else {
            header("location: /licitacao/file/download.php?file=$file");
		}
	} else {
		if(!validarCnpj($_POST['cnpj'])){
          echo'Cnpj errado';
    	} else {
            header("location: /licitacao/file/download.php?file=$file");
		}
	}

	
    
?>