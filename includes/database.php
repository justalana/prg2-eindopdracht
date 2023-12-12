<?php
$host       = "localhost";
$user       = "root";
$password   = "";
$database   = "music_collection_advanced";

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());;
