<?php
if(!isset($_SESSION)){

    session_start();
}

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
    $day_per = "n.a.";
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
<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="well well-sm bg-success">
            <h1 class="fa fa-th-list fa-3x float-right text-soft"></h1>
            <h3>Daily Collection</h3>
            <h4><?php echo $day_sales ?> sales / <?php echo $day_trns ?> trans.</h4>
            <h4>$<?php echo $day_amt ?><small class="tiny">/<?php echo $target->day ?></small> ( <i class="fa fa-caret-<?php echo $day_level ?>"></i> <?php echo $day_per ?>%)</h4>
            <div class="progress progress-small">
                <div class="progress-bar" style="width: <?php echo $day_progress ?>%"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="well well-sm bg-info">
            <h1 class="fa fa-th-large fa-3x float-right text-soft"></h1>
            <h3>Weekly Collection</h3>
            <h4><?php echo $week_sales ?> sales / <?php echo $week_trns ?> trans.</h4>
            <h4>$<?php echo $week_amt ?><small class="tiny">/<?php echo $target->week ?></small> ( <i class="fa fa-caret-<?php echo $week_level ?>"></i> <?php echo $week_per ?>%)</h4>
            <div class="progress progress-small">
                <div class="progress-bar" style="width: <?php echo $week_progress ?>%"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="well well-sm bg-primary">
            <h1 class="fa fa-calendar fa-3x float-right text-soft"></h1>
            <h3>Monthly Collection</h3>
            <h4><?php echo $month_sales ?> sales / <?php echo $month_trns ?> trans.</h4>
            <h4>$<?php echo $month_amt ?><small class="tiny">/<?php echo $target->month ?></small> ( <i class="fa fa-caret-<?php echo $month_level ?>"></i> <?php echo $month_per ?>%)</h4>
            <div class="progress progress-small">
                <div class="progress-bar" style="width: <?php echo $month_progress ?>%"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">

        <script src="../assets/javascripts/Chart.js"></script>
        <canvas id="myChart" height="100"></canvas>
        <script>
            // Get context with jQuery - using jQuery's .get() method.
            var ctx = $("#myChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var myNewChart = new Chart(ctx);


            Chart.defaults.global.responsive = true;
            var options= {

                ///Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines : true,

                //String - Colour of the grid lines
                scaleGridLineColor : "rgba(0,0,0,.05)",

                //Number - Width of the grid lines
                scaleGridLineWidth : 1,

                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,

                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,

                //Boolean - Whether the line is curved between points
                bezierCurve : true,

                //Number - Tension of the bezier curve between points
                bezierCurveTension : 0.4,

                //Boolean - Whether to show a dot for each point
                pointDot : true,

                //Number - Radius of each point dot in pixels
                pointDotRadius : 4,

                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth : 1,

                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,

                //Boolean - Whether to show a stroke for datasets
                datasetStroke : true,

                //Number - Pixel width of dataset stroke
                datasetStrokeWidth : 2,

                //Boolean - Whether to fill the dataset with a colour
                datasetFill : true,

                //String - A legend template
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

            };
            var data = {
                labels: [<?php echo "'".implode("','",array_reverse($this_week_days))."'" ?>],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: []
                    },
                    {
                        label: "Store Sales",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: []
                    },
                    {
                        label: "Website Sales",
                        fillColor: "rgba(129,36,36,0.2)",
                        strokeColor: "rgba(129,36,36,1)",
                        pointColor: "rgba(129,36,36,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(129,36,36,1)",
                        data: [<?php echo implode(",",array_reverse($this_week)) ?>]
                    }
                ]
            };

            var myLineChart = new Chart(ctx).Line(data, options);
        </script>
    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            if ($("[rel=tooltip]").length) {
                $("[rel=tooltip]").tooltip();
            }
        });
    </script>

    <script>
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

    </script>

</div>