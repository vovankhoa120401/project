<?php


function connection(){
    
    $servername = "localhost";
    $username = "id17988637_root";
    $password = "uY&3#gzbtX(rtY|1";
    $dbName = 'id17988637_market';
    
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbName);
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;

}

?>