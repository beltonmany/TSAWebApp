<?php session_start() ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://bootswatch.com/4/lumen/bootstrap.css" />
    <title>Hello, world!</title>
    <style>
        table{width:100%;}
    </style>
  </head>
  <body>
    <?php include("backend/includes/header.php")?>
    <div class="container">
    
    <h1>Events</h1>
    <div class="row">
      <input class="form-control" id="myInput" type="text" placeholder="Search for a term or name...">
      <br>
    </div>
    <table class="table">
    <thead>
      <tr>
        <th scope="col">Event ID</th>
        <th scope="col">Event Name</th>
        <th scope="col">Is Team Event</th>
        <th scope="col">Max Seats</th>
        <th scope="col">Seats Taken</th>
        <th scope="col">Teams</th>

        <!--<th scope="col">Regionally Required</th>-->
        <!--<th scope="col">State Max</th>-->
        <!--<th scope="col">National Max</th>-->
        <!--<th scope="col">IsQualifying</th>-->
        <!--<th scope="col">IsOnsite</th>-->
        <th scope="col">Register</th>
      </tr>
    </thead>
    <tbody>
      <?php include("backend/includes/table.php")?>
    </tbody>
    </table>

    </div>
   
   <?php require("backend/includes/footer.php") ?> 
   <script>
        
        $(document).ready(() => {
            $("#logout").click(() => {
                $.ajax({
                    url:"backend/scripts/logout.php",
                    method:"post",
                    data:{},
                    success: (response) => {
                        location.reload(true);
                    }
                }); //end ajax
            }); //end logout click
            
            $("button#register").click(function(){
                $eventId = $(this).parent().prev().prev().prev().prev().prev().prev().text();
                $.ajax({
                    url:"backend/scripts/register.php",
                    method:"post",
                    data:{
                        "eId":$eventId
                    },
                    success: (response) => {
                        location.reload(true);
                    }
                }); //end ajax
            }); //end register click
            
            $("button#unregister").click(function(){
                $eventId = $(this).parent().prev().prev().prev().prev().prev().prev().text();
                $.ajax({
                    url:"backend/scripts/unregister.php",
                    method:"post",
                    data:{
                        "eId":$eventId
                    },
                    success: (response) => {
                        location.reload(true);
                    }
                }); //end ajax
            }); //end register click
            
            $("#myInput").on("keyup", function() {
                $value = $(this).val().toLowerCase();
                $("tbody").children().filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf($value) > -1)
                });
            });
            
            $("button#team").click(function(){
                $eventId = $(this).parent().prev().prev().prev().prev().prev().text();
                $.ajax({
                    url:"backend/scripts/eventInfo.php",
                    method:"post",
                    data: {"eID":$eventId},
                    success: function(response){
                        let split = response.split("---");
                        $(".modal-title").html(split[0])
                        $(".modal-body").html(split[1])
                    }
                });//end ajax
            }); //end team click
        }); //end document ready
   </script>
   
   <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" ></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

   </body>
</html>
