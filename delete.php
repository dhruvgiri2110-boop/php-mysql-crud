<?php

if ( isset($_GET["id"]) ) 
{
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $databse = "myshop";

    //Create connection
    $connection = new mysqli($servername, $username, $password, $databse);

    // perform query for  Delete record as per id
    $sql = "DELETE FROM clients WHERE id=$id";
    $connection->query($sql);   // performs $sql query in connected database
}
    header("location: /myshop/index.php");
    exit;

?>