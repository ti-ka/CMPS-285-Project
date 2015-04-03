<?php
require_once("../class/Connection.php");
class FetchEditTable {
    private $table;
    private $results = array();

    public function __construct($table,$col,$val1,$val2,$from,$limit){

        $db_con = new Connection();
        $link = $db_con->connect();
        $this->table = $table;


        $sql = "SELECT * FROM `$table`";

        if($col != "" && $val1 == $val2){
            $sql = "SELECT * FROM `$table` WHERE `$col` = '$val1'";
        }

        //For Search
        if(strpos($val1,"%") != FALSE){
            $sql = "SELECT * FROM `$table` WHERE `$col` LIKE '$val1'";
        }

        if($col != "" && $val1 != $val2){
            $sql = "SELECT * FROM `$table` WHERE `$col` BETWEEN '$val1' AND '$val2'";
        }



        if($limit != 0) {
            $sql .= " LIMIT $limit`";
        }


        //echo $sql;


        $query = mysqli_query($link, $sql);

        while($row = $query->fetch_assoc()){
            array_push($this->results,$row);
        }


        $link->close();
    }

    public function getResults(){
        return $this->results;
    }
}