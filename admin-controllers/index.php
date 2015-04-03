<?php require_once("header.php") ?>

<?php
if(isset($_GET["show_homepage"])){
    require_once("sales-analysis.php");
} else {
    require_once("about-controller.php");
}

?>
<?php require_once("footer.php") ?>
