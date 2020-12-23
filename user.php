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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="backend/scripts/dnd.js"></script>
    <script src="https://kit.fontawesome.com/9287c8a8c9.js" crossorigin="anonymous"></script>
    <title>TSA Users Page</title>
    <style>
        table, tr{width:100%;}
        .box{  cursor: move;}
        .draggable {padding: 0.5em; float: left; margin: 10px 10px 10px 0; }
        .droppable { width: 150px; height: 150px; padding: 0.5em; float: left; margin: 10px; }
    </style>
  </head>
  <body>
   <?php include("backend/includes/header.php")?>
    <div class="container">
      <br/>
      <h1>User's Teams</h1>
      <?php if($_SESSION["type"] == "admin")?> <button data-toggle="modal" data-target="#myModal" class="btn btn-primary">Sort Teams</button>
      <br>
      <br>
      <div class="row">
      <input class="form-control" id="myInput" type="text" placeholder="Search for a term or name...">
      <br>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Events</th>
            <th scope="col">Requests</th>
          </tr>
        </thead>
      <tbody id="users">
      <?php include("backend/includes/users.php") ?>  
      </tbody>
      </table>
    </div>
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
            
            $("#myInput").on("keyup", function() {
                $value = $(this).val().toLowerCase();
                $("#users").children().filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf($value) > -1)
                });
            });
            
            $("[data-toggle=popover]")
            .popover({html:true})
            
            $(".profile").click(function(){
                $("#update").text("");
                $("#info").children().last().remove();
                $("#bio").children().last().remove();
                $("#save").remove();
                $uId = $(this).attr("id");
                $.ajax({
                    url: "backend/scripts/userInfo.php",
                    method: "post",
                    data: {"id":$uId},
                    success: (response) => {
                        $spl = response.split("---");
                        $update = $spl[0];
                        $info = $spl[1];
                        $bio = $spl[2];
                        $end = $spl[3];
                        
                        $("#update").text($update);
                        $("#info").append($info);
                        $("#bio").append($bio);
                        $("#end").append($end);
                }
            }); // end ajax    
            }); //end profile click
            
            $("#exampleModal").on("click", "#save", function(){
                $text = $("#desc").val();
                $.ajax({
                    url:"backend/scripts/save.php",
                    method:"post",
                    data:{"save":$text},
                    success: (response) => {
                        $('#exampleModal').modal('toggle')
                    }
                }); //end ajax
            }); //end save click
            
            $(".adReq").click(function(){
                $("#body2").empty();
                $id = $(this).parent().prev().prev().children().attr("id");
                $.ajax({
                    url:"backend/includes/viewForm.php",
                    method:"post",
                    data:{"id":$id},
                    success: (response) => {
                        $("#body2").append(response);
                    }
                });//end ajax
            });//end adreq click
            
            $("#sub").click(function(){
                $.ajax({
                    url:"backend/scripts/submit.php",
                    method:"post",
                    data:{"array":$newArr.toString()},
                    success: (response) => {
                         $("#body").empty();
                         $("#foot").empty();
                         $("#body").append($("<div></div>").text("Your request has been processed."))
                    }
                }); //end ajax
            }); //end sub click
            
            $("#label").click(function(){
                $.ajax({
                    url:"backend/includes/form.php",
                    method:"post",
                    data:{},
                    success: (response) => {
                        $("#sort").append(response);
                    }
                }); //end ajax
            });//end label click
            
            $(document).on("click", ".subBtn", function(){
                $selected = $(this).parent().prev().children().last().val();
                $.ajax({
                    url:"backend/includes/sortForm.php",
                    method:"post",
                    data:{"eId":$selected},
                    success: (response) => {
                        $("#sort").append(response);
                    }
                })
            });//end sort on click
        }); //end document ready
        
        
   </script>
   
        <!-- User Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="update">User Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group" id="info">
                    <label for="recipient-name" class="col-form-label">Basic Info:</label>
                  </div>
                  <div class="form-group" id="bio">
                    <label for="message-text" class="col-form-label">Bio:</label>
                  </div>
                </form>
              </div>
              <div class="modal-footer" id="end">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Request Modal -->
       <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModal1" aria-hidden="true" id="exampleModal1">
        <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Teammate Request</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div id="body" class="modal-body">
                        <?php include("backend/includes/dragForm.php") ?>
                        </div>
                      <div id="foot" class="modal-footer">
                        <button id="sub" type="button" class="btn btn-primary">Submit</button>
                      </div>          
                </div>
                </div>
      </div>
       </div>
       
       <!-- View Modal -->
       <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModal2" aria-hidden="true" id="exampleModal2">
        <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">View Requests</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div id="body2" class="modal-body"></div>
                </div>
                </div>
       </div>
      </div>
      
       <!-- Sort Modal -->
    	<div class="modal fullscreen-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    	  <div class="modal-dialog" role="document">
    	    <div class="modal-content">
    	      <div class="modal-header">
    	        <h4 class="modal-title" id="myModalLabel">Sort Teams</h4>
    	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	      </div>
    	      <div id="sort" class="modal-body">
    	      <label for="label">Create a Team: &nbsp;</label><i id="label" class="fas fa-plus"></i>
    	      </div>
    	      <div class="modal-footer">
    	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    	        <button id="saveSort" type="button" class="btn btn-primary">Save changes</button>
    	      </div>
    	    </div>
    	  </div>
    	</div>
    	
   <?php require("backend/includes/footer.php") ?> 
   </body>
</html>
