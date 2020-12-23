<?php session_start();

include("../includes/connect.php");

$eId = $_POST["eID"];

$query = "select * from events where id=$eId";
$res = $tsaConn->query($query);

while($row=$res->fetch_assoc()){
    echo $row['eName'];
    echo "---";
    echo "Event on ".$row['eDate']."<br>";
    echo "Description: ".$row['description'];
    
    $q1 = "select * from registration right join users on trim(registration.userID)=trim(users.id) where eventID=$eId";
    $res1 = $tsaConn->query($q1);
    echo "<table>";
    echo "<tr><th scope='col'>Team Number</th>";
    echo "<th scope='col'>Team Members</th>";
    echo "<th scope='col'>Graduation Year</th>";
    echo "<th scope='col'>Contact Information</th></tr>";
    while($row1 = $res1->fetch_assoc()){
    
    $name = $row1['first']." ".$row1['last'];
     echo "<tr><td scope='col'>".$row1['teamId']."</td>";
    echo "<td scope='col'>$name</td>";
    echo "<td scope='col'>".$row1['gradYear']."</td>";
    echo "<td scope='col'>".$row1['email']."</td></tr>";
    }
    echo "</table>";
     // echo "Team ID: ".$row2['team']
}
?>