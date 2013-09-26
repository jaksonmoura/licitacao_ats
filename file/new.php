<?php 
include '../session.php';
include '../partials/before_actions.php';
include '../partials/header.php';
?>
<html>
<head>
<title>File Upload with PHP</title>
<link href="../assests/css/style.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.form.js"></script>
<script>
$(document).ready(function()
{
    $('#FileUploader').on('submit', function(e)
    {
        e.preventDefault();
        $('#uploadButton').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output").html('<div style="padding:10px"><img src="images/ajax-loader.gif" alt="Please Wait"/> <span>Uploading...</span></div>');
        $(this).ajaxSubmit({
        target: '#output',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{
    $('#FileUploader').resetForm();  // reset form
    $('#uploadButton').removeAttr('disabled'); //enable submit button
}
</script>

</head>
<body>
<form action="uploader.php" id="uploader" enctype="multipart/form-data" method="post" >
    <label>Nome do arquivo</label>
    <input type="text" name="title" id="title" />
    <br/>
    <label>Escolha um arquivo</label>
    <input type="file" name="name" id="name" />
    <br/>
    <button type="submit" class="red-button" id="uploadButton">Enviar</button>
</form>
</body>
</html>