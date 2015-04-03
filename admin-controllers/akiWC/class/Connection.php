<?php
require_once("../class/Error.php");
class Connection
{
    private $host = "localhost";
    private $db = "myliveca_madeinnepaldk";
    private $user = "myliveca_dev";
    private $pass = "OBD;9G&%OChs10[#";
    public $link;


    public function __construct(){
        $link = mysqli_connect(
            $this->host,
            $this->user,
            $this->pass,
            $this->db
        );
        if(!$link){
            echo "Connection to Failed.";
        } else {
            $this->link = $link;
        }
    }

    public function connect()
    {
        return $this->link;
    }


}
