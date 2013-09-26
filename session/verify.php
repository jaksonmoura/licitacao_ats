<?php 

if(isset($_POST['submit'])){ 
    include '../connection.php';

    $usr = $link->real_escape_string($_POST['username']);
    $pas = hash('sha512', $link->real_escape_string($_POST['password'])); 
    $sql = $link->query("SELECT * FROM users WHERE username='$usr' AND password='$pas' LIMIT 1"); 
    if(mysqli_num_rows($sql) == 1){ 
        $row = mysqli_fetch_array($sql); 
        session_start(); 
        $_SESSION['username'] = $row['username'];
        $_SESSION['logged'] = TRUE;
        $_SESSION['message'] = 'Você entrou!';
        header("Location: ../file/list.php"); // Modify to go to the page you would like 
        exit; 
    }else{ 
        header("Location: login.php"); 
        exit; 
    } 
}else{    //If the form button wasn't submitted go to the index page, or login page 
    header("Location: login.php");     
    exit; 
} 
?>