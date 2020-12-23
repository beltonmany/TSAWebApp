<?php
$tsaConn = new mysqli("localhost", "aeneasb_boop", "sungisveryawesome1", "aeneasb_TSA");
if(mysqli_connect_errno())
    echo "Connection failed: ".mysqli_connect_error();

?>