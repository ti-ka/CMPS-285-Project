<?php
if(!isset($link)){
    require_once("../class/Connection.php");
    $db = new Connection();
    $link = $db->link;
}

//First Let us get target, Daily

$p = file_get_contents("../config/".$_SESSION['namespace']."_target.json");
$target = json_decode($p."",false);



$now = new DateTime("now");


//Today or Day 7
$this_week = array();
$this_week_days = array();

for($i = 0; $i < 7; $i++){
    $now->sub(new DateInterval('P1D'));
    $date = $now->format("Y-m-d");
    $sql = "SELECT SUM(sales_amount) FROM `sales` WHERE `aki_date` = '$date'";
    $query = $link->query($sql);
    $result = mysqli_fetch_assoc($query);
    $sales = $result["SUM(sales_amount)"];
    if($sales == "") $sales = 0;
    array_push($this_week,$sales);
    array_push($this_week_days,$now->format("l"));
}

//For Daily
$now = new DateTime("now");
$date = $now->format("y-m-d");
$sql = "SELECT `aki_date` FROM `sales` WHERE `aki_date` = '$date'";
$day_sales = mysqli_num_rows($link->query($sql));
$sql = "SELECT `aki_date` FROM `transactions` WHERE `aki_date` = '$date'";
$day_trns = mysqli_num_rows($link->query($sql));
$day_amt = round($this_week[0],2);
//For today % change
if($this_week[1] == 0){
    $day_per = 0;
} else{
    $day_per = round(($this_week[0] - $this_week[1])/$this_week[1] * 100,1);
}
$day_level = ($day_per > 0) ? "up" : "down";
//For Progress
$day_progress = $day_amt/($target->day) * 100;




//For Weekly
$now = new DateTime("now");
$temp = new DateTime("last monday");
$sql = "SELECT `aki_date` FROM `sales` WHERE `aki_date` BETWEEN '{$temp->format("Y-m-d")}' AND '{$now->format("Y-m-d")}'";
$week_sales = mysqli_num_rows($link->query($sql));
$sql = "SELECT `aki_date` FROM `transactions` WHERE `aki_date` BETWEEN '{$temp->format("Y-m-d")}' AND '{$now->format("Y-m-d")}'";
$week_trns = mysqli_num_rows($link->query($sql));

$sql = "SELECT SUM(sales_amount) FROM `sales` WHERE `aki_date` BETWEEN '{$temp->format("Y-m-d")}' AND '{$now->format("Y-m-d")}'";
$query = $link->query($sql);
$result = mysqli_fetch_assoc($query);
$sales_this_week = $result["SUM(sales_amount)"];

$temp2 = new DateTime("last monday");
$temp2->sub(new DateInterval('P7D'));
$temp2->format("Y-m-d");

$sql = "SELECT SUM(sales_amount) FROM `sales` WHERE `aki_date` BETWEEN '{$temp2->format("Y-m-d")}' AND '{$temp->format("Y-m-d")}'";
$query = $link->query($sql);
$result = mysqli_fetch_assoc($query);
$sales_last_week = $result["SUM(sales_amount)"];

$week_amt = round($sales_this_week);
if($sales_last_week == 0){
    $week_per = "n.a.";
} else{
    $week_per = round(($sales_this_week - $sales_last_week)/$sales_last_week * 100,1);
}
$week_level = ($week_per > 0) ? "up" : "down";
$week_progress = $week_amt/($target->week) * 100;


//For Monthly

$now = new DateTime("now");
$date = $now->format("Y-m")."%";
$sql = "SELECT `aki_date` FROM `sales` WHERE `aki_date` LIKE '$date'";
$month_sales = mysqli_num_rows($link->query($sql));
$sql = "SELECT `aki_date` FROM `transactions` WHERE `aki_date` LIKE '$date'";
$month_trns = mysqli_num_rows($link->query($sql));

$sql = "SELECT SUM(sales_amount) FROM `sales` WHERE `aki_date` LIKE '$date'";
$query = $link->query($sql);
$result = mysqli_fetch_assoc($query);
$sales_this_month = $result["SUM(sales_amount)"];

$now = new DateTime("last month");
$date = $now->format("Y-m")."%";
$sql = "SELECT SUM(sales_amount) FROM `sales` WHERE `aki_date` LIKE '$date'";
$query = $link->query($sql);
$result = mysqli_fetch_assoc($query);
$sales_last_month = $result["SUM(sales_amount)"];

$month_amt = round($sales_this_month);
if($sales_last_month == 0){
    $month_per = "n.a.";
} else{
    $month_per = round(($sales_this_month - $sales_last_month)/$sales_last_month * 100,1);
}
$month_level = ($month_per > 0) ? "up" : "down";
$month_progress = $month_amt/($target->month) * 100;

$ar = [
    "day_per" => $day_per,
    "day_trns" => $day_trns,
    "day_sales" => $day_sales,
    "day_amt" => $day_amt,
    "week_per" => $week_per,
    "week_trns" => $week_trns,
    "week_sales" => $week_sales,
    "week_amt" => $week_amt,
    "month_per" => $month_per,
    "month_trns" => $month_trns,
    "month_sales" => $month_sales,
    "month_amt" => $month_amt
];

echo "<script> var salesData = ".json_encode($ar)."</script>";

?>

    <script type="text/javascript">
        $(document).ready(function () {
            var Ar = [
                "per","trns","sales"
            ]

            var namesp = "day"
            for(var i  = 0; i<Ar.length; i++){
                var item = Ar[i];
                var val = salesData[namesp+"_"+item];
                $("."+namesp+"_"+item+"_badge").text(val);
                if(parseFloat(salesData[""+namesp+"_per"]) > 0){
                    $("."+namesp+"_"+item+"_badge").addClass('bg-success');
                } else {
                    $("."+namesp+"_"+item+"_badge").addClass('bg-danger');
                }
            }
            var namesp = "week"
            for(var i  = 0; i<Ar.length; i++){
                var item = Ar[i];
                var val = salesData[namesp+"_"+item];
                $("."+namesp+"_"+item+"_badge").text(val);
                if(parseFloat(salesData[""+namesp+"_per"]) > 0){
                    $("."+namesp+"_"+item+"_badge").addClass('bg-success');
                } else {
                    $("."+namesp+"_"+item+"_badge").addClass('bg-danger');
                }
            }
            var namesp = "month"
            for(var i  = 0; i<Ar.length; i++){
                var item = Ar[i];
                var val = salesData[namesp+"_"+item];
                $("."+namesp+"_"+item+"_badge").text(val);
                if(parseFloat(salesData[""+namesp+"_per"]) > 0){
                    $("."+namesp+"_"+item+"_badge").addClass('bg-success');
                } else {
                    $("."+namesp+"_"+item+"_badge").addClass('bg-danger');
                }
            }
        });

    </script>

</div>