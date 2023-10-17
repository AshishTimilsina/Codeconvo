<?php
$servername="localhost";
$username="root";
$password="";
$database="codeconvo";

$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    echo mysqli_connect_error();
}

?>