<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="https://bootswatch.com/4/lumen/bootstrap.css" />

    <title>TSA</title>
  </head>
  <body>
   <?php include("backend/includes/header.php")?>
    
    <div class="container">
      <h1>TSA Events Home Page</h1>
      <div class="row">
        <div class="col-xs col-sm col-md-6 my-auto">
          <h1>Log In</h1>
            <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button id="signin" type="submit" class="btn btn-danger">Log In</button>
          </form>
        </div>
        <div class="col-xs col-sm col-md-6">
          <h1>Sign Up</h1>
    
          <form method="post">
            <div class="form-group">
              <label for="exampleInputEmail2">Email address</label>
              <input name="email" type="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="exampleInputFirst">First Name</label>
              <input name="first" type="text" class="form-control" id="exampleInputFirst" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="exampleInputLast">Last Name</label>
              <input name="last" type="text" class="form-control" id="exampleInputLast" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="exampleInputGrad">Graduation Year</label>
              <input name="year" type="text" class="form-control" id="exampleInputGrad" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="exampleInputId">Student Id</label>
              <input name="id" type="text" class="form-control" id="exampleInputId" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword2">Password</label>
              <input name="pass" type="password" class="form-control" id="exampleInputPassword2">
            </div>
            <button id="signup" type="submit" class="btn btn-danger">Sign Up</button>
          </form>

        </div>
      </div>
    </div>
    
    <?php require("backend/includes/footer.php")?>
    <script>
        $(document).ready(() => {
            
            $("#signin").click(() => {
                event.preventDefault();
                
                $mail = $("#exampleInputEmail1").val();
                $pass1 = $("#exampleInputPassword1").val();
                
                if(!($mail == "" || $pass1 == "")){
                    
                    $.ajax({
                        url:"backend/scripts/signin.php",
                        method:"post",
                        data:{ 
                            "email":$mail,
                            "pass":$pass1
                        },
                        success: (response) => {
                            if(response!="") alert("sign in error");
                            else {
                                window.location.href = './events.php';
                            }
                        }
                    });//end ajax
                }else{
                    alert("missing field");
                }
            }); //end signin click
            
            $("#signup").click(() => {
                event.preventDefault();
                
                $first = $("#exampleInputFirst").val();
                $last = $("#exampleInputLast").val();
                $email = $("#exampleInputEmail2").val();
                $year = $("#exampleInputGrad").val();
                $id = $("#exampleInputId").val();
                $pass = $("#exampleInputPassword2").val();
                
                if(!($first == "" || $last == "" || $email == "" || $year == "" || $id == "" || $pass == "")){
                    
                    $.ajax({
                        url:"backend/scripts/signup.php",
                        method:"post",
                        data:{ 
                            "first":$first,
                            "last":$last,
                            "email":$email,
                            "year":$year,
                            "id":$id,
                            "pass":$pass
                        },
                        success: (response) => {
                             window.location.href = './events.php';
                        }
                    });//end ajax
                }else{
                    alert("missing field");
                }
            }); //end signup click
        });//end document ready
    </script>
  </body>
</html>