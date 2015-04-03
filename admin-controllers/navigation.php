<?php
    //Grabbing Categories
    require_once("../class/Category.php");
    $C = new Category("../config/".$namespace."_cat.json");
    $category = $C->getCat();

    $date = new DateTime("now");
    $today = $date->format("Y-m-d");
    $year = $date->format("Y");
    $month = $date->format("Y-m");
    $week_start = (new DateTime("last monday"))->format("Y-m-d");



    function get_cat(){
        global $category;
        array_Sex($category, "");
    }


    function array_Sex($val,$level){
        if($val != ""){
            if(count($val) == 1 && is_string($val)){
                echo "<li><a href='akiWC/default/index.php?add=true&table=inventory&col=cat_id&val=$level'>$val</a>";   //Item
            } else {
                //Array! Have Sex Again
                //Title
                if($level == "")
                    echo "<li><a href='#'><i class=\"fa fa-leanpub\"></i>Stock Ledger</a>";
                else
                    echo "<li><a href='#'>$val[0]<i class='float-right fa fa-chevron-down'></i></a>";

                echo "<ul>";
                for($i = 1; $i < count($val); $i++){
                    $l = ($level == "") ? $i : $level.".".$i;
                    echo array_Sex($val[$i],$l); //The level goes like 1.2
                }
                echo "</ul></li>"; //Ends
            }
        }
    }



?>
<nav class="navbar navbar-default nav-white">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Business Management Console</a>
        </div>

        <div class="collapse navbar-collapse no-pad" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form class="navbar-form navbar-left" role="search">
                        <input type="text" name="search" class="form-control" id="navbar-search" placeholder="Filter items" autocomplete="off">
                        <button type="submit" id="navbar-search-btn"><i class="fa fa-search"></i></button>
                    </form>
                </li>
                <li rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Go to Store/POS"><a href="pos.php"><i class="fa fa-shopping-cart xx"></i> &nbsp;</a></li>
                <li rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="View Website"><a href="../controllers/shop.php" data-ajax="false"><i class="fa fa-globe xx"></i> &nbsp;</a></li>
                <li class="dropdown info-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-bell"></i><sup><span class="badge nav-badge">1</span></sup></a>
                    <ul class="dropdown-menu nav-dropdown" role="menu">
                        <li></li>
                        <li>
                            <a href="#">
                                <h5>Store Sales</h5>
                                <p>Item "Something" has been sold to some Mr. Someone </p>
                            </a>
                        </li>
                        <li><a href="#"><i class="fa fa-chevron-circle-right"></i> &nbsp; See all notifications</a></li>
                    </ul>
                </li>
                <li class="dropdown info-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-envelope"></i></a>
                    <ul class="dropdown-menu nav-dropdown" role="menu">
                        <li></li>
                        <li>
                            <a href="#" class="media-template">
                                <img src="../assets/images/person.ico">
                                <div>
                                    <h5>Sammy Adams</h5>
                                    <p>Hello there!</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="media-template">
                                <img src="../assets/images/person.ico">
                                <div>
                                    <h5>Is that you?</h5>
                                    <p>I don't know about that but that really pissed me off.I don't know about that but that really pissed me off.</p>
                                </div>
                            </a>
                        </li>
                        <li><a href="#"><i class="fa fa-chevron-circle-right"></i> &nbsp; See all messages</a></li>
                    </ul>
                </li>
                <li><a href="logout.php" data-ajax="false"><i class="fa fa-power-off"></i> &nbsp;</a></li>
            </ul>
        </div>
    </div>
</nav> <!-- Top nav ends -->

<div id="main">
    <div id="left-vertical-nav">
        <ul class="well btn-group-vertical btn-block vertical-nav">
            <li>
                <a href="#" class="btn btn-default media-template">
                    <img src="../assets/images/person.ico">
                    <div>
                        <h5>Xen Sneskaskoi</h5>
                        <h6>Dummy Manager</h6>
                    </div>
                </a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o"></i>Sales Analysis</a>
                <ul>
                    <li><a href="sales-analysis.php">Today <span class="badge float-right day_per_badge">--</span></a></li>
                    <li><a href="sales-analysis.php">Week<span class="badge float-right week_per_badge">--</span></a></li>
                    <li><a href="sales-analysis.php">Month<span class="badge float-right month_per_badge">--</span></a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-ticket"></i>Sales Register</a>
                <ul>
                    <li><a href="akiWC/default/index.php?table=sales&col=aki_date&val=<?php echo $today ?>">Today<span class="badge float-right day_sales_badge">--</span></a></li>
                    <li><a href="akiWC/default/index.php?table=sales&col=aki_date&val=<?php echo $week_start ?>&val2=<?php echo $today ?>">Week<span class="badge float-right week_sales_badge"">--</span></a></li>
                    <li><a href="akiWC/default/index.php?table=sales&col=aki_date&val=<?php echo $month ?>%">Month<span class="badge month_sales_badge float-right">--</span></a></li>
                    <li><a href="akiWC/default/index.php?table=sales">All Records<span class="badge float-right"></span></a></li>

                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-database"></i>Transactions Register</a>
                <ul>
                    <li><a href="akiWC/default/index.php?table=transactions&col=aki_date&val=<?php echo $today ?>">Today<span class="badge float-right week_trns_badge">--</span></a></li>
                    <li><a href="akiWC/default/index.php?table=transactions&col=aki_date&val=<?php echo $week_start ?>&val2=<?php echo $today ?>">Week<span class="badge float-right week_trns_badge">--</span></a></li>
                    <li><a href="akiWC/default/index.php?table=transactions&col=aki_date&val=<?php echo $month ?>%">Month<span class="badge float-right month_trns_badge">--</span></a></li>
                    <li><a href="akiWC/default/index.php?table=transactions">All Records<span class="badge float-right"></span></a></li>

                </ul>
            </li>

            <?php get_cat(); ?>


            <li><a href="#"><i class="fa fa-bookmark"></i> Site Analysis</a></li>
            <li>
                <a href="#"><i class="fa fa-edit"></i>Content Management</a>
                <ul>
                    <li><a href="#">Table 1<span class="badge float-right">2</span></a></li>
                    <li><a href="#">Table 2<span class="badge float-right">6</span></a></li>
                    <li><a href="#">Table 3<span class="badge float-right">4</span></a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-user"></i> Users</a></li>
            <li><a href="#"><i class="fa fa-users"></i> Clients</a></li>
            <li><a href="#"><i class="fa fa-history"></i> Logs</a></li>
            <li><a href="admin/"><i class="fa fa-cog"></i> Preferences</a></li>
            <li><a href="ht.po"><i class="fa fa-exclamation-triangle"></i> Throw Error Test</a></li>
            <li><a href="about-controller.php"><i class="fa fa-info"></i> About</a></li>
        </ul>

    </div> <!-- Left nav ends -->
    <div id="explorer">