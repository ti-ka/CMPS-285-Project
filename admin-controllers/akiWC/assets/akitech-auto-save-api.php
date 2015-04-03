<?php
/*
This file is created and property of Akitech Labs(akitech.org)
Used here with permission
You may not use, copy or re-produce this file without the owner permission.
mail@akitech.org

*/

require("../class/Connection.php");	//Connection File
$db_con = new Connection();
$link = $db_con->connect();


if(isset($_POST["action"])){
$data = $_POST;
} elseif(isset($_GET["action"])) {
$data = $_GET;
}


//If the form data is sent
if (isset($data["action"]) && isset($data["table"])){

    //table is same as the MYSQLI TABLE NAME
    $table =  mysqli_real_escape_string($link,$data["table"]);
    $action =  mysqli_real_escape_string($link,$data["action"]);
    
   
   
    if($action=="insert")
    {
      //This is to add new entry
      $insert = "";
      $values = "";
      
       
        foreach ($data as $index => $value) {
         
        if ($index == "submit" || $index == "action" || $index == "table" || $index == "redirect_uri" || $index == "no-entry" || $index == "col"|| $index == "id"){continue;}

        $index = mysqli_real_escape_string($link,$index);
	    $value = nl2br(mysqli_real_escape_string($link,$value));

        $insert .= " `{$index}`,";
        $values .= "'{$value}',";

        }


        //Now Files


        foreach($_FILES as $name=>$data){
            if($data["size"] > 0){
                $value = upload($name);
                if ($value != false) {
                    $insert .= " `$name`,";
                    $values .= "'{$value}',";
                }
            }
        }

        //Adding items
        $date = new DateTime("now");

        $insert .= " `aki_user`, `aki_date`, `aki_time`, `aki_avail`, `aki_edited`";
        $values .= "'{$_SESSION["username"]}', '{$date->format('Y-m-d')}', '{$date->format('h:i:s')}','1','0' ";



          $sql = "INSERT INTO `".$table."` ({$insert}) VALUES ({$values})";

          $query = mysqli_query($link, $sql);
          if (mysqli_affected_rows($link)==1){
            $_SESSION["message"] = "<p  class='well bg-success'>The entry is successful.</p>";
             } else {
            $_SESSION["message"] = "<p class='well bg-danger'>Failed to make the entry. ".mysqli_error($link)."</p>";
          }
          
    }
    else if ($action == "delete")
    {
      if(isset($data["col"]) && isset($data["id"])){
          $col = mysqli_real_escape_string($link,$data["col"]);
          $id = mysqli_real_escape_string($link,$data["id"]);
          $sql = "UPDATE `".$table."` SET `aki_avail` = '0' WHERE `{$col}` = '{$id}'";

          $query = mysqli_query($link, $sql);
          if (mysqli_affected_rows($link)==1){
            $_SESSION["message"] = "<p  class='well bg-success'>Successfuly Deleted. Aproval may be required for finalisation.</p>";
             } else {
            $_SESSION["message"] = "<p class='well bg-danger'>Failed to delete the entry. ".mysqli_error($link)."</p>";
          }
      
      }
      
      else
      {      
	  $_SESSION["message"] =  "<p class='well bg-danger'>Delete failed. No Col/ID provided.</p>";
      }
  
          
    
    }
    else if ($action == "update")
    {
      // This is to update
        if(isset($data["col"]) && isset($data["id"])){
            $col = mysqli_real_escape_string($link,$data["col"]);
            $id = mysqli_real_escape_string($link,$data["id"]);
            $string = "";
      
        foreach ($data as $index => $value) {
            $index = mysqli_real_escape_string($link,$index);
	        $value = nl2br(mysqli_real_escape_string($link,$value));
            if ($index == "submit" || $index == "action" || $index == "table" || $index == "redirect_uri" || $index == "no-entry" || $index == "col" || $index == "id"){
                continue;
            } else {
                $string .= " `{$index}` = '{$value}',";
            }
        
        }

            //Now Files

            foreach($_FILES as $name=>$data){
                if($data["size"] > 0){
                   // unlink("../../images/uploads/".$data[$name]);
                    $value = upload($name);
                    if ($value != false) {
                        $string .= " `{$name}` = '{$value}',";
                    }
                }
            }


            //Adding items
            $date = new DateTime("now");

            $string .= "`aki_user` = '{$_SESSION["username"]}', `aki_date`= '{$date->format('Y-m-d')}', `aki_time` = '{$date->format('h:i:s')}', `aki_avail` = '1', `aki_edited` = '1' ";



            $sql = "UPDATE `{$table}` SET {$string} WHERE `{$col}` = '{$id}'";

          $query = mysqli_query($link, $sql);
          if (mysqli_affected_rows($link)==1){
            $_SESSION["message"] =  "<p  class='well bg-success'>The update is successful.</p>";
             } else {
            $_SESSION["message"] =  "<p class='well bg-danger'>Failed to update the entry. ".mysqli_error($link)."</p>";
          }
        
      }
      else
      {      
	  $_SESSION["message"] =  "<p class='well bg-danger'>Update failed. No Col/ID provided.</p>";
      }
  


    } 
    else
    {
	  $_SESSION["message"] =  "<p class='well bg-danger'>Invalid Actions</p>";
          
    }

}
else {
	$_SESSION["message"] =  "<p class='well bg-danger'>Invalid Paramaters</p>";
}

$link->close();
echo $_SESSION["message"];
unset($_SESSION["message"]);


/*
 upload function
 */

function upload($name){
    $target = "../../../assets/uploads/";
    $allowedExts = array(
        "gif", "jpeg", "jpg", "png","JPG","PNG","GIF","JPEG"
    );
    $temp = explode(".", $_FILES[$name]["name"]);
    $extension = end($temp);
    $filename = $name."_".rand(12345678,3456789045678)."_".rand(12345678,3456789045678).".".$extension;

    if (($_FILES[$name]["size"] < 10000000) && in_array($extension, $allowedExts)) {

        if ($_FILES[$name]["error"] > 0) {
            $message =  "File Upload Unsuccessful. Error: " . $_FILES[$name]["error"] ;
            echo $message;
            exit();
            return false;
        } else {
            if(move_uploaded_file($_FILES[$name]["tmp_name"],"$target" . $filename)){
                //$message = "File Successfully Uploaded. ";
                return $filename;
            } else{
                $message =  "File Upload Unsuccessful. Error: " . $_FILES[$name]["error"];
                echo $message;
                exit();
                return false;
            }

        }

    } else {
        $message = "Invalid file. File must be jpg/gif/png and below 10 MB";
        echo $message;
        exit();
        return false;
    }
}

?>