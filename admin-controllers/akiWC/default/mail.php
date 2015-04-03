
<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="container rows">
    <div class="col-md-2" id="menu">
        <?php require_once("nav.php") ?>
    </div>
    <div class="col-md-10" id="detail">
        <?php
        if (isset($_GET["email"]) && isset($_GET["name"])){

            require_once("../class/Connection.php");
            $db_con = new Connection();
            $link = $db_con->connect();

            $email = mysqli_real_escape_string($link,$_GET["email"]);
            $name = mysqli_real_escape_string($link,$_GET["name"]);
            echo "  <h3>Send Mail to $name</h3>
                <form method='POST' action='send_mail.php'>
                  <label>Name:</label><input type='text' name='value' value='$name'><br />
                  <label>Email:</label><input type='text' name='email' value='$email'><br />
                  <label>Subject:</label><input type='text'  name='subject'/><br />
                  <label>Message: </label><textarea rows='15' id='editor' name='message'></textarea><br />

                <input type='submit' value='Send'>
                </form>
        ";
        } else {
            echo "<h3>Send Mail to all the subscribers:</h3>
           <form method='POST' action='send_mail.php'>
                <label>Subject:</label><input type='text'  name='subject'/><br />
                <label>Message:</label><textarea rows='15' id='editor' name='message'></textarea><br />
                <input type='submit' value='Send'>
            </form>

       ";
        }
        ?>

    </div>
</div>

<script src="../editor/ckeditor.js"></script>

<script>
    /*
     CKEDITOR.replace( 'editor1', {
     filebrowserBrowseUrl: 'http://localhost/www/fileman/index.php',
     filebrowserUploadUrl: '/uploader/upload.php'
     });
     */

    var roxyFileman = '../../images/fileman/index.html';
            //$(function(){
            CKEDITOR.replace( 'editor',{filebrowserBrowseUrl:roxyFileman,
                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                removeDialogTabs: 'link:upload;image:upload'});


</script>

</body>

</html>