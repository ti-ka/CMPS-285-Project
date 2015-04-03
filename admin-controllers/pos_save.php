<?php
session_start();
require_once("../class/Connection.php");
$db = new Connection();
$link = $db->link;


$data = json_decode($_POST["sales"],true);

$salesPerson = $_SESSION["username"];
$client = $data["client"];
$sum = $data["sum"];
$count = $data["count"];
//This is the not of arrays in items not the actual no of items For eg if 1 item is sold twice, count = 1
$items = $data["items"]; //Array of items

//Record Sales
$date = new DateTime();

$sql = "INSERT INTO `sales` (`trans_count`,`sales_amount`,`aki_user`,`aki_date`,`aki_time`) VALUES ('$count','$sum','$salesPerson','{$date->format("Y-m-d")}','{$date->format("h:i:s")}')";
$query = $link->query($sql);
$sales_id = mysqli_insert_id($link);

$names = "";
foreach($items as $item){
    $id = $item["dataId"];
    $qty = $item["qty"];

    $sql = "SELECT * FROM `inventory` WHERE `id` = '$id'";
    $result = mysqli_query($link, $sql);
    $fetch = mysqli_fetch_assoc($result);
    $name = $fetch["name"];
    $names .= $name." ($qty), ";
    $cat_id = $fetch["cat_id"];
    $stock_quantity = $fetch["stock_quantity"];
    if($stock_quantity != "-1"){
        $stock_quantity = $stock_quantity - $qty;
        $sql = "UPDATE `inventory` SET `stock_quantity` = '$stock_quantity' WHERE  `id` = '$id'";
        $query = $link->query($sql);
    }


    $sql = "INSERT INTO `transactions` (`sales_id`,`item_id`,`item_name`,`qty`,`price`,`discount`,`aki_user`,`aki_date`,`aki_time`) VALUES ('$sales_id','$id','$name','$qty','{$item["price"]}','0','$salesPerson','{$date->format("Y-m-d")}','{$date->format("h:i:s")}')";
    $query = $link->query($sql);
}

$names = substr($names,0,strlen($names)-2);

$sql = "UPDATE `sales` SET `items` = '$names' WHERE `id` = '$sales_id'";
$query = $link->query($sql);


echo "Sale Successful.";