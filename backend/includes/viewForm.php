<?php session_start(); 
include("connect.php");

$id = $_POST["id"];
$q = "select * from wants join users on trim(wants.reqId)=trim(users.id) where userId=$id";
$res = $tsaConn->query($q);
$div = "";
while($row=$res->fetch_assoc()){
    if($div != $row["eventId"] && $row["eventId"] == -1) echo "</ul><ul class=\"list-group\"><li class=\"list-group-item\"><h3>Wanted Teammates</h3></li>";
    else if($div != $row["eventId"]){
        $q1 = "select * from events where id=".$row["eventId"]." limit 1";
        $res1 = $tsaConn->query($q1);
        $row1 = $res1->fetch_assoc();
        $eName = $row1["eName"];
        echo "</ul><ul class=\"list-group\"><li class=\"list-group-item\"><p>$eName</p></li>";
    }
    echo "<li class=\"list-group-item\">".$row["first"]." ".$row["last"]."</li>";
    $div = $row["eventId"];
}
echo "</ul>";
?>