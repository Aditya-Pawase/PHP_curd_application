<?php
$servername="localhost";
$username="root";
$password="";
$dbname="project_curd";
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
    die('cant connect'.$conn->connect_error);
}
else{
    echo "connection successfull";
}
?>
