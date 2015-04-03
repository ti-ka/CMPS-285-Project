<?php
session_start();
require_once("../class/Connection.php");
require_once("../class/Category.php");
$c = new Connection();
$link = $c->link;

$sql = "SELECT * FROM `inventory` WHERE `aki_avail` = '1' AND 'stock_quantity' != '0'";
$query = mysqli_query($link,$sql);
$a = array();
while($row = mysqli_fetch_assoc($query)){
    array_push($a, $row);
}

$cat = new Category("../config/".$_SESSION["namespace"]."_cat.json");
$cat = $cat->getCat();

echo "<script> var cat = ".json_encode($cat)."</script>";
echo "<script> var items = ".json_encode($a)."</script>";

?>

<span id="user-total" style="display:none">0.00</span>

<div class="rows">
    <div class="col-md-8" id="items">
        <!-- items from JS -->
    </div>
    <div class="col-md-4 well well-sm">
        <h3 class="text-soft">Sales</h3>
        <div id="sales">
            <!-- items after clicking -->
        </div>
    </div>

</div>

<script src="../assets/javascripts/jQuery-2.1.3.min.js"></script>
<script>
    //Setting the Buttons
    $(document).ready(function(){

        var current = parseFloat(localStorage.getItem("amount")) || 0.00
        $("#user-total").text(current.toFixed(2));


        var sales = {
            client : "",
            count: 0,   //No of items
            sum : 0.00, //Sum of transactions
            items : {
                //Empty Array
            }

        }


        for (var i = 0; i < items.length; i++){
            var item = items[i]
            var stock = item["stock_quantity"];

            if(stock != 0){
                if(stock == "-1")
                    stock = ""
                /*
                 if(stock.indexOf(".00") == stock.length-3)
                 stock = stock.substring(0,stock.length-3)
                 */


                var str = "<div class='btn-sales' data-id='"+item["id"]+
                    "' array-id='"+i+"'>"+"<img class='thumb-btn' src='../assets/uploads/"+
                    item["image"]+"'/><div><span class='badge float-right'>"+
                    stock+"</span>"+item["name"] +
                    "<br /><small>" +cat[item["cat_id"]]  +"</small>"+
                    "<br /><small>$" +item["price"] +"/" +
                    item["unit"] +"</small></div></div>"
                $("#items").append(str);
            }
        }

        $("body").on("click","div.btn-sales", function(){
            var dataId = $(this).attr("data-id");
            var arrayId = $(this).attr("array-id");


            var curr = $(this).find('span').text()
            if(curr != ""){
                curr = parseInt(curr)-1
                if(curr == 0){
                    $(this).hide();
                } else {
                    $(this).find('span').text(curr)
                }
            }

            //console.log(dataId)

            var position = findPosition(dataId,sales)

            if(position == -1){
                var transaction = {}
                transaction["dataId"] = dataId
                transaction["arrayId"] = arrayId
                transaction["qty"] = 1
                transaction["price"] = parseFloat(items[arrayId]["price"])
                sales.items[sales.count] = transaction
                sales.count++;
                sales.sum += parseFloat(items[arrayId]["price"])
            } else {
                var qty = sales.items[position]["qty"]
                qty++

                sales.items[position]["qty"] = qty

                //sales.count++;
                sales.sum += parseFloat(items[arrayId]["price"])
            }

            console.log(sales)
            showSales(sales)

            // $("#sales").append(items[dataId]["name"]);

        })


        function findPosition(id,sales){

            for(var i = 0; i < sales.count; i++){
                if(sales.items[i]["dataId"] == id) //dataId
                    return i;
            }
            return -1;

        }

        function showSales(sales){
            if(sales.count == 0){
                $("#sales").html("")
                return
            }
            var str = "<table>"
            var total = 0

            for(var i = 0; i < sales.count; i++)
            {
                str += "<tr>"

                var qty = sales.items[i]["qty"]
                var arrayId = sales.items[i]["arrayId"]


                var item = items[arrayId]

                var name = item["name"]
                var unit = item["unit"]
                var price = item["price"]  * qty
                price = price.toFixed(2);

                total += parseFloat(price)


                str += "<td>" + name + "</td>"
                str += "<td>" + qty + " " + unit + "</td>"
                str += "<td class='text-right'>" + price + "</td>"

                str += "</tr>"
            }

            str += "<tr><td colspan='2'>Total</td><td class='text-right'>"  +total.toFixed(2) +"</td></tr>"
            str += "</table>"

            str += "<div><a class='btn btn-success' id='pay'><i class='fa fa-check-square-o'></i> Checkout</a></div>"

            $("#sales").html(str)
        }

        $("body").on("click","a#pay", function(){

            var salesUpload = JSON.stringify(sales);
            console.log(salesUpload)

            $.ajax({
                type: "POST",
                url: "pos_save.php",
                cache: false,
                beforeSend: function( xhr ) {
                    xhr.overrideMimeType( "text/plain; charset=utf-8" );
                },
                data: {sales: salesUpload }
            })
                .done(function( msg ) {
                    //$("#pay").parent().html("<p>"+msg+"</p>")
                    var current = parseFloat(localStorage.getItem("amount"))
                    current += sales.sum;
                    localStorage.setItem("amount",current.toFixed(2));
                    $("#user-total").text(current.toFixed(2));
                    sales = {
                        salesPerson : "admin",
                        client : "",
                        count: 0,   //No of items
                        sum : 0.00, //Sum of transactions
                        items : {
                            //Retting Sales
                        }

                    }
                    alert(msg)
                });



        })







    })
</script>