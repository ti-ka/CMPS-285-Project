<?php
require_once("../class/Connection.php");
$db_con = new Connection();
$link = $db_con->connect();

if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["message"])) {

    $email = mysqli_real_escape_string($link,$_GET["email"]);
    $name = mysqli_real_escape_string($link,$_GET["name"]);
    $message = mysqli_real_escape_string($link,$_GET["message"]);
    $subject = mysqli_real_escape_string($link,$_GET["subject"]);

    str_replace("@name",$name,$message);
    str_replace("@name",$name,$subject);
    str_replace("@email",$email,$message);
    str_replace("@email",$email,$subject);

    $headers = 'From: '."info@baikalpiksamuha.com"."\r\n".
        'Reply-To: '.$email."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    $mail =  @mail($email, $subject, $message, $headers);


}
if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["message"])==1) {

    $message = mysqli_real_escape_string($link,$_GET["message"]);
    $subject = mysqli_real_escape_string($link,$_GET["subject"]);

    $query = mysqli_query($link, "SELECT * FROM `subscribers`");
    while ($row = mysqli_fetch_assoc($query)){
        $name = $row["name"];
        $email = $row["email"];

        str_replace("@name",$name,$message);
        str_replace("@name",$name,$subject);
        str_replace("@email",$email,$message);
        str_replace("@email",$email,$subject);

        $headers = 'From: '."info@baikalpiksamuha.com"."\r\n".
            'Reply-To: '.$email."\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $mail =  @mail($email, $subject, $message, $headers);

    }
}

if (!@mail) {
    $_SESSION["message"] = "Failed to send email.";
} else {
    $_SESSION["message"] =  "Email sent!";
}
header("Location:index.php?table=subscribers");
exit();
?>