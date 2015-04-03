<?php

class Category {


    private $cat = array() ;
    private $file = "";
    private $readable = array();

    public function __construct($file){
        $this->file = $file;
        $p = file_get_contents($file);
        $this->cat = json_decode($p."",false);

    }

    function save(){
        file_put_contents($this->file,json_encode($this->cat));
    }

    public function get_data($cat_id){

        $arr = $this->cat;
        if($cat_id != ""){

            if(strpos($cat_id,".") != false){
                $i = explode(".",$cat_id);
            } else {
                $i = array($cat_id);
            }

            try{
                for($j = 0; $j < count($i); $j++){
                    $arr = $arr[$i[$j]];
                }

            } catch(Exception $e){
                echo "Invalid Item Index";
                return false;
            }
        }

        if(count($arr) == 1 && is_string($arr[0])){
            return $arr;
        }

        for($j = 0; $j <count($arr); $j++){
            if(is_array($arr[$j])){
                //This has categories
                $arr[$j] = $arr[$j][0] . " &darr;";
            }
        }

        array_shift($arr); //Removing First Element

        return $arr;
    }



    public function endsWith($haystack, $needle) {

        $pos = strrpos($haystack,$needle) + strlen($needle);

        return $pos == strlen($haystack);
    }


    public function  getCat(){
        return $this->cat;
    }

    public function add($cat_id,$item){
        $loc = $this->cat;
        $pos = count($loc);

        if($cat_id != "") {
            foreach (explode('.', $cat_id) as $step)
            {
                $loc = $loc[$step];
            }
            $pos = $cat_id.".".count($loc); //Pushing at end
        }

        $this->set($pos,$item);

    }

    public function set($cat_id,$val)
    {
        $loc = &$this->cat;
        foreach(explode('.', $cat_id) as $step)
        {
            $loc = &$loc[$step];
        }
        return $loc = $val;
    }

    public function remove($cat_id){
        $this->set($cat_id,"");
    }

    public function print_readable(){
        array_Sex($this->cat, "");
    }

    private function array_Sex($val,$level){
        if($val != ""){
            if(count($val) == 1 && is_string($val)){
                echo "<li>".$level . "=>" .$val."</li>";   //Item
            } else {
                //Array! Have Sex Again
                //Title
                if($level != "")    //Skipping for base of all arrays
                    echo "<li>".$level . "=>" .$val[0]."</li>";

                echo "<ul>";
                for($i = 1; $i < count($val); $i++){
                    $l = ($level == "") ? $i : $level.".".$i;
                    echo array_Sex($val[$i],$l); //The level goes like 1.2
                }
                echo "</ul>"; //Ends
            }
        }
    }



/*
    function repair(&$arr){
        for($i = 0; $i < count($arr); $i++){
            if(is_array($arr[$i])){
                $this->repair($arr[$i]);
            } else {
                if($arr[$i] == "h"){
                    echo "Removing ".$arr[$i] ." in ".$i." <br />";
                    unset($arr[$i]);
                }
            }
        }
    }
*/

}
