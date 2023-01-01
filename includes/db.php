<?php

$db['dbServer'] = "localhost";
$db['dbUsername'] = "root";
$db['dbPassword'] = "";
$db['dbName'] = "web_blog";

// Looping through each to make them into constants.
foreach($db as $key => $value){
  define(strtoupper($key), $value); //It is good practice to upper case it.
}

$conn = new mysqli(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

//$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

if(!$conn){
  echo "We are not connected";
} else {
  //echo "We are connected";
}


 ?>
