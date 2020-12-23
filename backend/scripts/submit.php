<?php session_start();

include("../includes/connect.php");

$userId = $_SESSION["id"];
$arr = $_POST["array"];
$str_arr = explode(",", $arr);
foreach($str_arr as $arr){
    $x = explode(":",$arr);
    $eventId = $x[0];
    $reqId = substr($x[1], 0, -2);
    $q = "insert into wants values ($userId, $reqId, $eventId)";
    $tsaConn->query($q);
}
?>