<html>
<head>
  <title>Sign Up Form</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>

    $(document).ready(function() {

      // MAKE AJAX REQUEST FOR SIGN UP THE USER
      $('#signup-form').submit(function() {
        event.preventDefault();
  
        $.ajax({
          url: '/lms/dummy/controller/signup_controller.php',
          type: 'post',
          data: $('#signup-form').serialize(),
          datatype : "json",
          success: function(response) {
            console.log(response);
            console.log(typeof(response));
            result = JSON.parse(response);
            console.log(JSON.parse(response));

            if (result.success == 'TRUE') {
              console.log(response);
              document.getElementById("signup-form").reset();
              alert('Thank you for signing up!');
            } 
            else {
              $('#error').html(result.message);
            }
          }
        });
      });
      
      // MAKE AJAX REQUEST FOR SHOWING THE 
      $("#ShowUser").click(function() {
        $.ajax({
          url: "/lms/dummy/controller/dash_controller.php",
          type: "GET",
          success: function(response) {
            result = JSON.parse(response);
            console.log(result);
            if (result.success == 'TRUE') {
              console.log(response);
              $('#ShowUserResult').html(result.message);
            } 
            else {
              $('#error').html(result.message);
            }
          }
        });
      });
    });

    
     
    



  </script>
</head>
<body>
  <h1>Sign Up Form</h1>
  <form id="signup-form" method="post">

    <label for="username">username</label>
    <input type="text" id="username" name="username"><br>

    <label for="name">fname:</label>
    <input type="text" id="fname" name="fname"><br>
    
    <label for="name">lname:</label>
    <input type="text" id="lname" name="lname"><br>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br>
    
    <label for="confirm-password">Confirm Password:</label>
    <input type="password" id="confirm-password" name="confirm_password"><br>
    
    <label for="contact">contact</label>
    <input type="text" id="contact" name="contact"><br>
    
    <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="male" checked>
          <label class="form-check-label" for="gridRadios1">
            Male
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Female">
          <label class="form-check-label" for="gridRadios2">
            Female
          </label>
        </div>
        <div class="form-check disabled">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="other" >
          <label class="form-check-label" for="gridRadios3">
            Other
          </label>
        </div>
      </div>
    </div>
       <input type="submit" value="Sign Up">
  </form>

    
    
  <!-- HERE ALL THE ERROR WILL GO -->
  <div id="error"></div>

</body>
</html>
