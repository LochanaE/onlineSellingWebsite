<?php
$host="localhost";
$user="root";
$database="sample_facebook";
$password="";

if($conn=new mysqli($host,$user,$password,$database)){
    //continue
}else{
    //exit if not connect to database
    echo'Error database connection';
    exit;
}
?>