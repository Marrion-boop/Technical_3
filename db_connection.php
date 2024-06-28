<?php
function OpenCon()
{
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_2";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
return $conn;
}
function CloseCon($conn)
{
$conn -> close();
}
?>