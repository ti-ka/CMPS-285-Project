<?php

session_start();

if(!isset($_SESSION["access"]) && $_SESSION["access"] != true){
    header("Location:login.php");
    exit();
}

$namespace = $_SESSION["namespace"];
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="description" content="Business Management Console">
    <meta name="author" content="Akitech Research Labs">
    <title>Business Management Console</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../assets/images" type="image/png" />
    <link rel="stylesheet" href="../assets/stylesheets/bootstrap-superhero.css">
    <link rel="stylesheet" href="../assets/font-awesome-4.3.0/css/font-awesome.min.css">
    <script src="../assets/javascripts/jQuery-2.1.3.min.js"></script>
    <script src="../assets/javascripts/bootstrap.min.js"></script>
    <script src="../assets/javascripts/admin.js"></script>
    <link rel="stylesheet" href="../assets/stylesheets/custom-style-admin.css">

</head>
<body>
<?php require_once("navigation.php"); ?>
