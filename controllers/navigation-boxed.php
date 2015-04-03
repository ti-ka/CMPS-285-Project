<nav class="navbar navbar-default">
    <div class="container-fluid container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">deep<span class="text-warning">south</span>whitetails</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-cart-arrow-down"></i>&nbsp; Free Delivery in Louisiana</a></li>
                <li><a href="#"><i class="fa fa-calendar"></i>&nbsp; 14 days return</a></li>
                <li><a href="#"><i class="fa fa-check-square-o"></i>&nbsp; 12 years Experience</a></li>
                <li><a href="cart.php"><i class="fa fa-shopping-cart"></i>&nbsp;  Shopping Cart &nbsp;<span class="badge">2</span></a></li>

            </ul>
        </div>
    </div>
    <div class="container-fluid container second-level">
        <div class="collapse navbar-collapse no-pad" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav">
                <li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="shop.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-cart-plus"></i>&nbsp; Shop <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="shop.php"><i class="fa fa-home"></i>&nbsp; Store Home</a></li>
                        <li class="divider"></li>
                        <li class="panel-heading"><i class="fa fa-align-center"></i>&nbsp; Categories</li>
                        <li><a href="item.php">Floor Mats</a></li>
                        <li><a href="#">Blankets</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="fa fa-magic"></i>&nbsp; Find Your Own</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="fa fa-heart"></i>&nbsp; Popular Items</a></li>
                        <li><a href="#"><i class="fa fa-line-chart"></i>&nbsp; Hot Items</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-magic"></i>&nbsp; Find Your Own</a></li>
                <li><a href="#"><i class="fa fa-smile-o"></i>&nbsp; Offers &nbsp; <span class="badge">12</span></a></li>

                <li>
                        <form class="navbar-form navbar-left" role="search">
                            <input type="text" name="search" class="form-control" id="navbar-search" placeholder="Search items" autocomplete="off">
                            <button type="submit" id="navbar-search-btn" class="btn btn-default"><i class="fa fa-search"></i>&nbsp;</button>
                        </form>
                    </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-facebook-official"></i>&nbsp; Facebook</a></li>
                <li><a href="#"><i class="fa fa-instagram"></i>&nbsp; Instagram</a></li>
                <!--
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search items" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>&nbsp;</button>
                </form>
                -->
            </ul>
        </div>
    </div>
</nav>
<script>
    $("body").on("click","#navbar-search-btn",function(){
        if($("#navbar-search").is(':visible')){

            return true
        } else {
            $("#navbar-search").animate({width:'toggle'},350)
            return false
        }

    })

</script>