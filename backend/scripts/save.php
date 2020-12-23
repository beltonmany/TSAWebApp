<?php session_start();

include("../includes/connect.php");

$q = "UPDATE users SET bio =\"".$_POST["save"]."\"where id=".$_SESSION["id"];
$tsaConn->query($q);

?>