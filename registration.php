<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Webconnect-Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style type="text/css">
      .error{
        color: red;
      }
    </style>
  </head>
  <body>
    <?php
    include 'navbar.php';
    ?>
    <!-- Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-sm-12 mx-auto mt-5">
          <div id="messages"></div>
       <div class="card">
        <div class="card-header bg-primary text-white">
          Register Yourself
        </div>
        <div class="card-body">
          <form id="regForm" action="doLogin.php" method="post">
            <div class="mb-3">
              <label class="form-label" for="first_name">First Name</label>
              <input type="text" name="first_name" id="first_name" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label" for="last_name">Last Name</label>
              <input type="text" name="last_name" id="last_name" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label" for="email">Email-ID</label>
              <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="d-grid gap-2">
            <input type="submit" name="Register" class="btn btn-primary" value="Register">
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="validator/dist/jquery.validate.js"></script>
     <script type="text/javascript">
      $(document).ready(function() {
          $("#regForm").validate({
              rules: {
                first_name: {
                  required: true
                },
                last_name: {
                  required: true
                },
                email: {
                  required: true,
                  email: true
                }
              }
            })
          });
  /*Ajax Form Submit*/
$(document).ready(function() {
      $("#regForm").submit(function(e){
        if(! $(this).valid()){
          return false;
        }
        e.preventDefault();
        $.ajax({
        type: "POST",
        url: "function.php",
        data: $('#regForm').serialize()+"&Register", 
        success: function(data){
            $("#messages").html(data);
        },
        // Alert status code and error if fail
        error: function (xhr, ajaxOptions, thrownError){
            alert(xhr.status);
            alert(thrownError);
        }
       });
    });
  });
/*//*/
    </script>
  </body>
</html>