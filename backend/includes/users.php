<?php session_start(); 

include("backend/includes/connect.php");

$query = "select * from users";
$res = $tsaConn->query($query);
while($row = $res->fetch_assoc()){
    echo "<tr> <td><a class=\"profile\" id=\"".$row["id"]."\" href=\"#\" data-toggle=\"modal\" data-target=\"#exampleModal\">".$row["first"]." ".$row["last"]."</a></td>";
    $q1 = "select * from registration join events on trim(events.id)=trim(registration.eventID) where userID=".$row["id"]; 
    $res1 = $tsaConn->query($q1);
    echo "<td>";
    while($row1 = $res1->fetch_assoc()){
        echo "<a class=\"event\" id=\"".$row1["id"]."\" href=\"#\" data-toggle=\"popover\" title=\"".$row1["eName"]."\" data-content=\"".$row1["description"]."\">| ".$row1["eName"]." |</a>";
    }
    if($_SESSION["id"] == $row["id"]) echo "<a href=\"./events.php\"> ...add/remove an event</a>";
    echo "</td>";
    if($_SESSION["id"] == $row["id"]) 
        echo "<td><button class=\"btn btn-primary req\" data-toggle=\"modal\" data-target=\"#exampleModal1\"> Make a team/teammate request </button></td>";
    else if($_SESSION["type"] == "admin"){
        echo "<td><button class=\"btn btn-primary adReq\" data-toggle=\"modal\" data-target=\"#exampleModal2\"> See Individual Requests</button></td>";
    }
    else{
        echo "<td>private</td>";
    }
    echo "</tr>";
}
?>