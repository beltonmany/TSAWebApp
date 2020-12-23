<?php session_start();
include("connect.php");
$eId = $_POST["eId"];
$query = "select distinct registration.eventID, events.eName from registration join events on trim(registration.eventID)=trim(events.id) where eventID=$eId";
$q = "select * from registration join users on trim(users.id)=trim(registration.userID) where eventID=$eId";

$r = $tsaConn->query($query);
$res = $tsaConn->query($q);

$row1=$r->fetch_assoc();
$name = $row1["eName"];
echo "<div id=\"".$r["eventID"]."\" class=\"ui-widget-header droppable\"><p>$name</p></div>";

while($row=$res->fetch_assoc()){
    echo "<div id=\"id".$row["id"]."id\"draggable=\"true\" class=\"ui-widget-content draggable box\">".$row["first"]." ".$row["last"]."</div>";
}
?>

