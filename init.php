<?php include 'db.php';?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP MySQL Sample Application</title>
    <link rel="stylesheet" href="style.css" />
</head>

<?php

$sqlTable="DROP TABLE IF EXISTS MESSAGES_TABLE";
if ($mysqli->query($sqlTable)) {
    echo "Table dropped successfully! <br>";
} else {
	echo "Cannot drop table. "  . mysqli_error();
}


echo "Executing CREATE TABLE Query...<br>";
$sqlTable="
CREATE TABLE MESSAGES_TABLE (
 ID bigint(20) NOT NULL AUTO_INCREMENT,
 TIME TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
 MESSAGE varchar(255) DEFAULT NULL,
 PRIMARY KEY (ID)
) DEFAULT CHARSET=utf8
";

if ($mysqli->query($sqlTable)) {
    echo "Table created successfully!<br>";
} else {
	echo "Cannot create table. "  . mysqli_error();
}


?>


<button class = "mybutton" onclick="window.location = 'index.php';">Back</button>

</html>