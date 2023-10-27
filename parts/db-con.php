<?php
$connection = new mysqli("localhost","root","","hospital_management");
if($connection->connect_error){
    die("Connection failed !". $connection->connect_error);
}
?>