<?php session_start();

include("../includes/connect.php");

$result = $tsaConn->query("select * from users");

while($row = $result->fetch_assoc()){
    if($_POST["email"] == $row["email"] && $_POST["pass"] == $row["password"]){
        $_SESSION["first"] = $row["first"];
        $_SESSION["last"] = $row["last"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["year"] = $row["year"];
        $_SESSION["id"] = $row["id"];
        $_SESSION["pass"] = $row["pass"];
        $_SESSION["type"] = $row["type"];
        exit();
    }
        
}
echo "no"
?>