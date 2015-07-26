<?php
class view{
    public function __construct($db){
        $this->db=$db;
        $this->content="";
        $this->minify=0;
    }
    public function add($str){
        $this->content .= $str;
        return 1;
    }
    public function setminify($str){
        $this->minify=$str;
        return 1;
    }
    public function show(){
        $output = $this->content;
        echo $output;
    }
}
