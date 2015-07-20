<?php
if(!$_ENV["VCAP_SERVICES"]){ //local dev
    $mysql_server_name = "127.0.0.1:3306";
    $mysql_username = "root";
    $mysql_password = "";
    $mysql_database = "test";
} else { //running in Bluemix
    $vcap_services = json_decode($_ENV["VCAP_SERVICES" ]);
    $db = $vcap_services->{'mysql-5.5'}[0]->credentials;
    $mysql_database = $db->name;
    $mysql_port=$db->port;
    $mysql_server_name =$db->host . ':' . $db->port;
    $mysql_username = $db->username; 
    $mysql_password = $db->password;
}
//echo "Debug: " . $mysql_server_name . " " .  $mysql_username . " " .  $mysql_password;

$mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>