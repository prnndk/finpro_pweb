<?php

$servername = 'localhost';
$username = 'root';
$password = 'mlikiwe123';
$database = 'finpro_pweb';

// Create connection
$connect = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connect->connect_error) {
    exit('Connection failed: '.$connect->connect_error);
}
