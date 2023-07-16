<?php
include "conn.php";
include "functions.php";
include "includes/nav3.php";

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <title>HOME</title>
</head>

<body style="background-color: aliceblue;">


  <div class="container bg-info">
    <div class="card mt-5" width="75%">
      <div class="row">

        <div class="col-sm-6">
          <center>
            <h1 style="color:red; margin-top:25px">Contact Us</h1>
          </center>
          <div class="container"><img src="https://images.unsplash.com/photo-1463171379579-3fdfb86d6285?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fHdlYnNpdGV8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" width="100%" height="450px" alt="not found"></div>
        </div>
        <div class="col-sm-6 mt-3">
          <form action="" method="post">
            <div><input type="text" id="input" class="  form-control mb-2" placeholder="Full Name"></div>
            <div><input type="email" id="input" class="  form-control mb-2" placeholder="Email"></div>
            <div><input type="phone" id="input" class="form-control mb-2" placeholder="Phone Number"></div>
            <div> <textarea name="message" id="in" class="form-control mb-2" cols="30" rows="8" placeholder="Leave Message Here"></textarea>
            </div>
            <div> <button style="height:65px; border-radius:5px; width:120px; font-size:x-large;" type="submit" class="btn btn-primary mb-2 mt-2">submit</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  </div>
  <style>
    #input {
      height: 65px;
      width: 98%;
      border-radius: 5px;
    }

    #in {
      width: 98%;
      border-radius: 5px;
    }
  </style>

  <div class="mt-5">  <?php
  include "includes/footer.php";
  ?></div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>