<?php 
$path = '../assets/pdf/';

include '../partials/header.php';
include '../config/session.php';
 ?>
<div class="box tcenter">
<?php

if (!@file_exists($path)) {
    //destination folder does not exist
    die("Make sure Upload directory exist!");
}

if($_POST){
    if(!isset($_POST['title']) || strlen($_POST['title'])<1){
        die("<h3>O nome do arquivo está vazio!</h3><br/><span><a href='new.php'>« Voltar</a></span>");
    }

    if(!isset($_POST['category_id']) || strlen($_POST['category_id'])<1){
        die("<h3>Escolha uma categoria!</h3><br/><span><a href='new.php'>« Voltar</a></span>");
    }

    if(!isset($_FILES['name'])){
        die("<h3>Nenhum arquivo selecionado!</h3><br/><span><a href='new.php'>« Voltar</a></span>");
    }

    if($_FILES['name']['error']){
        die(upload_errors($_FILES['name']['error']));
    }

    $name        = strtolower($_FILES['name']['name']);
    $title       = mysqli_real_escape_string($link, $_POST['title']);
    $img_ext     = substr($name, strrpos($name, '.'));
    $type        = $_FILES['name']['type'];
    $size        = $_FILES['name']["size"];
    $rand_num    = rand(0, 9999999999);
    $uploaded_at = date("Y-m-d H:i:s");
    $category_id = $_POST['category_id'];

    switch(strtolower($type)){
        case 'image/png':
        case 'application/pdf':
        case 'application/msword':
        case 'application/vnd.ms-excel':
        case 'application/x-zip-compressed':
            break;
        default:
            die("<h3>Arquivo não suportado!</h3><br/><span><a href='new.php'>« Voltar</a></span>");
    }

    //File Title will be used as new File name
    $new_name = preg_replace(array('/s/', '/.[.]+/', '/[^w_.-]/'), array('_', '.', ''), strtolower($title));
    $new_name = $new_name.'_'.$rand_num.$img_ext;
   //Rename and save uploded file to destination folder.
   if(move_uploaded_file($_FILES['name']["tmp_name"], $path . $new_name )){
        //connect & insert file record in database
        $link->query("INSERT INTO files (name, title, created_at, updated_at, category_id) VALUES ('$new_name', '$title', '$uploaded_at', '$uploaded_at', '$category_id')");
        $_SESSION['message'] = 'Arquivo enviado com sucesso!';
        header('location: new.php');
   }else{
        die("<h3>Erro ao enviar aquivo!</h3><br/><span><a href='new.php'>« Voltar</a></span>");
   }
}

//function outputs upload error messages, http://www.php.net/manual/en/features.file-upload.errors.php#90522
function upload_errors($err_code) {
    switch ($err_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
    }
}
?>
</div>