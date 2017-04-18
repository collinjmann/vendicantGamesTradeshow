<?php
$servername = "vgtradeshow.db.5308118.hostedresource.com";
$username = "vgtradeshow";
$password = "P2ssw#rd";
$dbname = "vgtradeshow";
$tname = "responses";

#$conn = new mysqli($servername, $username, $password);
#$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
#$conn->query($sql);
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "CREATE TABLE IF NOT EXISTS $tname (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
fname VARCHAR(30) NOT NULL,
lname VARCHAR(30) NOT NULL,
email VARCHAR(50)
)";

$conn->query($sql);

$conn->close();

?>