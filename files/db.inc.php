<?php
/**
 * Author: Evin Darling (C00144257)
 * Date: March 2017
 * Description: Connects to the projects MySQL database
 */
$hostname = "localhost";
$username = "evn";
$password = "";
$dbname   = "equipmenthire";

$con = mysqli_connect($hostname, $username, $password, $dbname);
if(!$con)       // If a connection cannot be established, print error information
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}