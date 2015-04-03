<h3>Category Mgmt</h3>

<?php
require_once("Category.php");

$cat = new Category();

$list = $cat->getCat();


echo "<script>var cat = ".json_encode($list)."</script>";

?>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<select id='opt-selector'></select>

<script>
    var level = 0;

    function getSelect(level){
        var str = "<option value=''>Catagories of "+cat[0]+"</option>";
        for (var i = 1; i < cat.length; i++){
            var sub = cat[i];

            if(sub instanceof Array){
                str += "<option value='"+i+"'>" + sub[0] + " > </option>" ;
            } else {
                str += "<option value='"+i+"'>" + sub + "</option>" ;
            }
        }
        str += "</option>";
        return str;
    }


    $("document").ready(function(){
        $("#opt-selector").html(getSelect(0))
    });





</script>