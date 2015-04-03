<?php

session_start();

if(!isset($_SESSION["access"]) && $_SESSION["access"] != true){
    header("Location:../login.php");
    exit();
}
?>

<div class="row">
    <div class="col-md-12" id="detail">
       <?php

       require_once("../class/Connection.php");
       $db_con = new Connection();
       $link = $db_con->connect();

            if(isset($_SESSION["message"])){
                echo '<div class="alert alert-success" role="alert">'.$_SESSION["message"].'</div>';
                unset($_SESSION["message"]);
            }

            if(isset($_GET["table"])){
                $table = mysqli_real_escape_string($link, $_GET["table"]);

            } else {
                echo "No tables selected.";
                exit();
            }

            if(isset($_GET["col"]) && isset($_GET["val"])){
                $col = mysqli_real_escape_string($link, $_GET["col"]);
                $val = mysqli_real_escape_string($link, $_GET["val"]);
                if(isset($_GET["val2"])){
                    $val2 = mysqli_real_escape_string($link, $_GET["val2"]);
                } else {
                    $val2 = $val;
                }

            } else {
                $col = "";
                $val = "";
                $val2 = "";
            }

            if(isset($_GET["limit"])){
                $limit = mysqli_real_escape_string($link, $_GET["limit"]);
            } else {
                $limit = 0;
            }


           if(isset($_GET["from"])){
               $from = mysqli_real_escape_string($link, $_GET["from"]);
           } else {
               $from = 0;
           }

       //No add button is deafult
       if(isset($_GET["add"])){
           echo "<a href='akiWC/default/action.php?table=$table' class='float-right btn btn-primary'><i class='fa fa-plus-circle'></i> Add new</a>";
       }

            table($table,$col,$val,$val2,$from,$limit);

        $link->close();


            function table($table,$col,$val,$val2,$from,$limit)
            {

                require_once("../class/FetchEditTable.php");
                $t = new FetchEditTable($table,$col,$val,$val2,$from,$limit);
                $rows = $t->getResults();


                if(count($rows) == 0){
                    echo "<div class='well well-sm bg-danger'><i class='fa fa-ban'></i> &nbsp; No entries</div>";
                    return "";
                } else {
                    echo "<div class='well well-sm bg-success'><span id='results-count'>".count($rows). "</span> results found.</div>";
                }


                $skip = array("id","timestamp","aki_date","aki_time","aki_user","aki_edited","aki_avail");

                if($table == "subscribers"){
                    echo "<a href='mail.php' class='btn btn-success'><i class='fa fa-envelope'></i> Send to all</a>";
                }

                echo "<table>";

                //Title
                echo "<tr>";
                echo "<th>Action</th>";
                foreach ($rows[0] as $cell => $val) {
                    if (in_array($cell,$skip)) {
                        continue;
                    }
                    echo "<th>" . prepare_name($cell) . "</th>";
                }


                echo "<th>Entry Info</th>";

                echo "</tr>";


                //Content
                foreach ($rows as $row) {

                    if(!$row["aki_avail"]){
                        echo "<tr class='deleted'>";
                        echo "<td>";
                        echo "<a disabled class='btn btn-primary fa fa-pencil'></a>";
                        echo "<a disabled class='btn btn-danger fa fa-ban delete'></td>";
                        echo "</td>";
                    } else {
                        if($row["aki_edited"]){
                            echo "<tr class='edited'>";
                        } else {
                            echo "<tr>";

                        }

                        //INDEXING FOR EDIT
                        echo "<td>";
                        echo "<a href='akiWC/default/action.php?table=$table&action=update&col=id&id=".$row["id"]."' class='btn btn-primary fa fa-pencil'></a>";
                        echo "<a href='akiWC/assets/akitech-auto-save-api.php?table=$table&action=delete&col=id&id=".$row["id"]."' class='btn btn-danger fa fa-ban delete'></td>";


                        echo "</td>";
                    }




                    foreach ($row as $cell => $val) {
                        if (in_array($cell,$skip)) {
                            continue;
                        } else if($cell == "img" || $cell == "image"){
                            echo "<td><img class='thumb' src='../assets/uploads/" . $val . "'/></td>";
                        } else if($cell == "cv" || $cell == "photo" || $cell == "citizenship"){
                            echo "<td><a href='../../uploads/" . $val . "' class='glyphicon glyphicon-download-alt'> Download</a></td>";
                        } else if($cell == "password"){
                            echo "<td>**********</td>";
                        } else{
                            $val = (strlen($val) <= 200) ? $val : substr($val, 0, 200) . "...";
                            echo "<td>" . $val . "</td>";
                        }
                    }

                    $action = ($row["aki_edited"]) ? "Updated " : "Added ";
                    $action = ($row["aki_avail"]) ? $action : "Deleted ";
                    $user = $row["aki_user"];
                    $date = new DateTime($row["aki_date"]." ".$row["aki_time"]);
                    $date = $date->format("D, M j h:i a");
                    echo "<td data-more='$action by $user on<br/>$date'>$user</td>";

                    echo "</tr>";

                }
                echo "</table>";
            }
        ?>

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
<script>
    $(".delete").on("click", function(e){
        confirm("Sure to delete?");
    })
</script>