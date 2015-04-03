<div class="container">
    <div class="space60"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-sm-2" id="item-thumbs">
                    <img src="../assets/images/image_2_large.jpg" class="no-zoom">
                    <img src="../assets/images/image_3_large.jpg" class="no-zoom">
                    <img src="../assets/images/slide-03.jpg" class="no-zoom">
                </div>
                <div class="col-sm-10">
                    <img src="../assets/images/image_2_large.jpg" class="no-zoom" id="item-main-photo">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h2 class="text-danger no-pad">Some Item Name</h2>

            <table class="item-details">
                <tr>
                    <td>Colors</td>
                    <td>
                        <span class="badge" style="background: #212121">&nbsp;&nbsp;</span>
                        <span class="badge" style="background: #888">&nbsp;&nbsp;</span>
                        <span class="badge" style="background: #BD8E8E">&nbsp;&nbsp;</span>
                        <span class="badge" style="background: #852DAE">&nbsp;&nbsp;</span>
                    </td>
                </tr>
                <tr><td>Material</td><td>Felt</td></tr>
                <tr><td>Weight</td><td>3 kg<td></tr>
                <tr><td>Delivery time</td><td>3-4 weeks</td></tr>
                <tr><td>Description</td>
                    <td class="fix-characters" data-text="Item description goes here, if any. Click this content to <strong>see more</strong>. Wool is the textile fiber obtained from sheep and certain other animals, including cashmere from goats, mohair from goats, qiviut from muskoxen, angora from rabbits, and other types of wool from camelids.">
                        N/A
                    </td>
                </tr>

                <div id="item-desc">
                    </div>
                <tr>
                    <td id="item-price"></td>
                    <td><select id="item-selector">
                            <option value="49.99">7.9" / 20cm</option>
                            <option value="69.99">19.7" / 50cm</option>
                            <option value="129.99">27.6" / 70cm</option>
                        </select>
                    </td>
                </tr>
            </table>

            <a class="btn btn-lg btn-warning"><i class="fa fa-cart-plus"></i>&nbsp;Add to Cart</a>
            <a  href="cart.php" class="btn btn-lg btn-success"><i class="fa fa-check-square-o"></i>&nbsp;Add & Checkout</a>

        </div>

    </div>
</div>

<script src="../assets/javascripts/okzoom.js"></script>
<script>
    $(function(){
        $('#item-main-photo').okzoom({
            width: 200,
            height: 200,
            border: "1px solid #FFF",
            shadow: "0 0 5px #000"
        });
    });
    $("body").on("click","#item-thumbs img", function(){
        $("#item-main-photo").attr("src",$(this).attr("src"))
    })

    $("#item-price").html("$"+$("#item-selector").val()+"<small><br />incl. shipping + tax</small>")

    $("#item-selector").on("change",function(){
        $("#item-price").html("$"+$(this).val()+"<small><br />incl. shipping + tax</small>")
    })

    $(".fix-characters").html($(".fix-characters").attr("data-text").substring(0,100)+"...")

    $("body").on("click",".fix-characters",function(){
        if($(this).html().length >= 104){
            $(this).html($(this).attr("data-text").substring(0,100)+"...")
        } else {
            $(this).html($(this).attr("data-text"))
        }

    })
</script>