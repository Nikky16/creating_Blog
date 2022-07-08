<?php
    $server = 'localhost';
    $host = 'root';
    $password = '';
    $databaseName = 'blog';

    $con = mysqli_connect($server, $host, $password, $databaseName);
    if($con){
        // echo 'connected';
    }
?>