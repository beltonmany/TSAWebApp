<?php session_start();
include("../includes/connect.php");
$id = $_POST["id"];
$query = "select * from users where trim(id)=$id";
$res = $tsaConn->query($query);
$row = $res->fetch_assoc();

if($id == $_SESSION["id"]) echo "Update Your Profile---";
else{ echo $row["first"]."'s Profile---";}

echo "<ul class=\"list-group\">
  <li class=\"list-group-item\">Name: ".$row["first"]." ".$row["last"]."</li>
  <li class=\"list-group-item\">Contact: ".$row["email"]."</li>
  <li class=\"list-group-item\">Graduation Year: ".$row["gradYear"]."</li>";
if($_SESSION["type"] == "admin"){; ?>
<li class="list-group-item">
<div class="form-check">
  <input class="form-check-input" type="radio" name="radio" id="student" value="option1" <?php if($row["type"] != "admin") echo "checked"?>>
  <label class="form-check-label" for="student">
    Student
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="radio" id="admin" value="option2" <?php if($row["type"] == "admin") echo "checked"?>>
  <label class="form-check-label" for="admin">
    Admin
  </label>
</div>
</li>
</ul>---
<?php
}else{
    echo "</ul>---";
}

if($id == $_SESSION["id"] || $_SESSION["type"] == "admin") echo "<textarea  class=\"form-control\" id=\"desc\">".$row["bio"]."</textarea>---";
else{ echo "<textarea class=\"form-control\" id=\"desc\" disabled>".$row["bio"]."</textarea>---"; }

if($id == $_SESSION["id"] || $_SESSION["type"] == "admin") echo "<button type=\"button\" id=\"save\" class=\"btn btn-primary\">Save Bio</button>---";
?>