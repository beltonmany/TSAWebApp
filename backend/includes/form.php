<?php session_start(); 
include("connect.php");
?>
<div class="container">
  <div class="form-row align-items-center">
    <div class="col-auto my-1">
      <label class="mr-sm-2" for="inlineFormCustomSelect">Preference</label>
      <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
        <option selected>Choose...</option>
        <?php
        $q = "select distinct registration.eventID, events.eName from registration join events on trim(registration.eventID)=trim(events.id)";
        $res = $tsaConn->query($q);
        while($row=$res->fetch_assoc()){
            echo "<option value=\"".$row["eventID"]."\">".$row["eName"]."</option>";
        }
        ?>
      </select>
    </div>
    <div class="col-auto my-1">
      <button type="submit" class="subBtn btn btn-primary">Submit</button>
    </div>
  </div>
</div>