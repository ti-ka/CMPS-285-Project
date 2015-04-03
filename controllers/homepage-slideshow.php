<?php
    function isMobile(){
        $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
        if(
            strpos($ua,'android') != false ||
            strpos($ua,'blackberry') != false ||
            strpos($ua,'iphone') != false ||
            strpos($ua,'ipad') != false ||
            strpos($ua,'iemobile') != false
        ){
            return true;
        } else {
            return false;
        }
    }

    if(!isMobile()) {
        echo '
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img class="no-zoom" src="../assets/images/slide-02.JPG" alt="First slide">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Deer Deer Deer?</h1>
                    <h1>We Gotca for ya</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="shop.php" role="button">Buy Now <i class="fa fa-chevron-right"></i></a></p>
                </div>
            </div>
        </div>
        <!--
        <div class="item">
            <img class="no-zoom" src="../assets/images/slide-01.jpg" alt="Second slide">
            <div class="container">
                <div class="carousel-caption"style="top:25%">
                    <p><a class="btn btn-lg btn-danger" href="#" role="button">See Offers <i class="fa fa-chevron-right"></i> </a></p>
                </div>
            </div>
        </div>
        -->
        <div class="item">
            <img class="no-zoom" src="../assets/images/slide-03.JPG" alt="Third slide">
            <div class="container">
                <div class="carousel-caption">
                     <h1>Deer for ya all</h1>

                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-info" href="shop.php" role="button">Browse gallery <i class="fa fa-chevron-right"></i> </a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="fa fa-chevron-left fa-3x" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="fa fa-chevron-right fa-3x" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel -->';
    } else {
        echo '
<div class="container">
        <div class="we-beat-container">
            <a href="#"><i class="fa fa-chevron-right fa-5x"></i>
            <ul class="we-beat">
                    <li><a href="#"><i class="fa fa-cart-arrow-down"></i>&nbsp; Free Delivery in Denmark</a></li>
                    <li><a href="#"><i class="fa fa-calendar"></i>&nbsp; 14 days return</a></li>
                    <li><a href="#"><i class="fa fa-check-square-o"></i>&nbsp; 2 years Guarantee</a></li>
            </ul>
            </a>
        </div>
    <a class="btn btn-lg btn-block btn-primary" href="#" role="button">Design Custom Selve <i class="fa fa-chevron-right"></i></a>
    <a class="btn btn-lg btn-block btn-danger" href="#" role="button">See Offers <i class="fa fa-chevron-right"></i> </a>
    <a class="btn btn-lg btn-block btn-info" href="shop.php" role="button">Browse Gallery <i class="fa fa-chevron-right"></i> </a>
    <a class="btn btn-lg btn-block btn-success" href="cart.php" role="button">Shopping Cart <span class="badge">0</span> <i class="fa fa-chevron-right"></i> </a>
</div>
        ';
    }
    ?>

