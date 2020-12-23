<?php session_start();

include("../includes/connect.php");

$eId = $_POST["eId"];
$id = $_SESSION["id"];
if(isset($_SESSION["first"])){
    $query = "DELETE FROM `registration` WHERE eventID = $eId and userID = $id";
    $tsaConn->query($query);
    
    $q = "select seats from events where id = $eId";
    $res = $tsaConn->query($q);
    $row = $res->fetch_assoc();
    $num = $row["seats"]-1;
    $q1 = "UPDATE `events` SET `seats` = '$num' WHERE `events`.`id` = $eId";
    $tsaConn->query($q1);
}else{
    echo "alert(\"sign in first\")";
}

?>