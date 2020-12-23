<?php session_start(); 
include("backend/includes/connect.php");
$i = 0;
$q = "select * from users where id!=".$_SESSION["id"];
$res = $tsaConn->query($q);
$q1 = "select * from registration join events on trim(registration.eventID)=trim(events.id) where userID=".$_SESSION["id"];
$re = $tsaConn->query($q1);
while($r=$re->fetch_assoc()){
    echo "<div id=\"".$r["eventID"]."\" class=\"ui-widget-header droppable\"><p>".$r["eName"]."</p></div>";
    $i++;
}
?>
<div id="-1"class="ui-widget-header droppable">
  <p><?php if($i > 0){?> Other <?php } ?>Wanted Teammates</p> 
</div>
<?php
while($row=$res->fetch_assoc()){
    echo "<div id=\"".$row["id"]."id\"draggable=\"true\" class=\"ui-widget-content draggable box\">".$row["first"]." ".$row["last"]."</div>";
}
?>
