<?php

session_start();

if(!isset($_SESSION["access"]) && $_SESSION["access"] != true) {
    header("Location:../login.php");
    exit();
}

$namespace = $_SESSION["namespace"];


//Grabbing Categories
require_once("../../../class/Category.php");
$C = new Category("../../../config/" . $namespace . "_cat.json");
$category = $C->getCat();
$opt = "";
for ($i = 1; $i < count($category); $i++) { //Skipping first
    $opt .= "<option value='$i'>" . $category[$i] . "</option>";
}


?>
<div class="container row">
    <div class="col-md-12" id="detail">
        <?php
        require_once("../assets/prepare.php");
        require_once("../class/Row.php");
        require_once("../class/FetchFields.php");

        $row = new Row(
            $table,$action,$col,$id,$redirect_uri
        );

        if(isset($_SESSION["message"])){
            echo '<div class="alert alert-success" role="alert">'.$_SESSION["message"].'</div>';
            unset($_SESSION["message"]);
        }
        ?>

        <?php
            if($row->action == "update"){
                echo "<h1>".ucfirst($row->action)." from ".$row->table."</h1>";
            } else {
                echo "<h1>".ucfirst($row->action)." into ".$row->table."</h1>";
            }

        ?>


        <form method="POST" target="_blank" enctype="multipart/form-data" action="akiWC/assets/akitech-auto-save-api.php">
            <input type="hidden" name="redirect_uri" value="<?php echo $row->redirect_uri; ?>" />
            <input type="hidden" name="table" value="<?php echo $row->table; ?>" />
            <input type="hidden" name="action" value="<?php echo $row->action; ?>" />
            <input type="hidden" name="col" value="<?php echo $row->col; ?>" />
            <input type="hidden" name="id" value="<?php echo $row->id; ?>" />

            <?php

            $i = 1;
            foreach($row->data_types as $data_type){
                $name = $data_type->name;
                $type = $data_type->type;
                $length = $data_type->length;
                $select_vales = $data_type->values;
                if($data_type->decimal == 0){
                    $step = 1;
                } else {
                    $step = 1/($data_type->decimal);
                }

                if(
                    $data_type == "hidden"
                    || $name == "password"
                    || $name == "aki_date"
                    || $name == "aki_time"
                    || $name == "aki_user"
                    || $name == "aki_edited"
                    || $name == "aki_avail"
                    || $data_type == null
                    || $data_type == "null"
                    || $data_type == ""
                ){
                    continue;
                } else {

                    if($name == "cat_id"){
                        echo "\n\t<label>Category:</label><select name='cat_id' id='cat_id'>".$opt."</select><br />";
                        echo "<script>document.getElementById('cat_id').value = $select_vales</script>";
                        continue;
                    }



                    $val = ($row->action == "update") ? $row->vals[$name] : "";
                    if($type == "textarea"){
                        echo "\n\t<label>".prepare_name($name).":</label><textarea id='editor".$i."' rows=7 name='$name' maxlength='$length'>$val</textarea><br />";
                        $i++;
                    } else if($type == "number") {
                        echo "\n\t<label>".prepare_name($name)." :</label><input type='$type' name='$name' value='$val' maxlength='$length' step='$step'/><br />";
                    } else if($type == "select") {
                        echo "\n\t<label>".prepare_name($name)." :</label><select name='$name'>";

                        foreach($select_vales as $opt_value){
                            $selected = ($val == $opt_value) ? "selected" : "";
                            echo "<option value='$opt_value' $selected>".prepare_name($opt_value)."</option>";
                        }

                        echo "</select><br />";


                    } else {
                        echo "\n\t<label>".prepare_name($name)." :</label><input type='$type' name='$name' value='$val' maxlength='$length'/><br />";
                    }
                }

            }

            echo "<script>var editors = ".$i."</script>";
            ?>

            <input type="submit" class="btn btn-success" value="Save the Entry" />
        </form>


    </div>
</div>


</body>



<?php

function prepare_name($name){
    $name = explode("_",$name);
    $name = implode(" ",$name);

    $name = explode("-",$name);
    $name = implode(" ",$name);

    $name = preg_split('/(?=[A-Z])/',$name);
    $name = implode(" ",$name);

    return ucwords($name);


}

?>
<!--
<script src="../editor/ckeditor.js"></script>

<script>
    /*
     CKEDITOR.replace( 'editor1', {
     filebrowserBrowseUrl: 'http://localhost/www/fileman/index.php',
     filebrowserUploadUrl: '/uploader/upload.php'
     });
     */

    for(var i = 1; i <= editors; i++){
        var id = "editor"+i;
        console.log($("#"+id).attr("maxlength"))

        var rows = parseInt($("#"+id).attr("maxlength"))/100
        if(rows > 15){
            rows = 15
        }
        $("#"+id).attr("rows",rows)


/*
        if($("#"+id).attr("maxlength") >= 1000){
            var roxyFileman = '../../fileman/index.html';
            //$(function(){
            CKEDITOR.replace( id,{filebrowserBrowseUrl:roxyFileman,
                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                removeDialogTabs: 'link:upload;image:upload'});
            //});
        }
*/

    }


</script>
-->