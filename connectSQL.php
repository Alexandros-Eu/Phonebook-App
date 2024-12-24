<?php

    $config = require __DIR__ . '/config.php';

    $servername = $config['DB_SERVERNAME'];
    $username = $config['DB_USERNAME'];
    $password = $config['DB_PASSWORD'];
    $database = $config['DB_DATABASE'];


    $conn = new mysqli($servername, $username, $password, $database);

    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
        


