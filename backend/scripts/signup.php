<?php session_start();
require("../includes/connect.php");

$first = $_SESSION["first"] = $_POST["first"];
$last = $_SESSION["last"] = $_POST["last"];
$email = $_SESSION["email"] = $_POST["email"];
$year = $_SESSION["year"] = $_POST["year"];
$id = $_SESSION["id"] = $_POST["id"];
$pass = $_SESSION["pass"] = $_POST["pass"];

$query = "insert into users values ($id, \"$first\", \"$last\", \"$email\", \"$pass\", \"student\", $year, \"\")";
$tsaConn->query($query);
?>