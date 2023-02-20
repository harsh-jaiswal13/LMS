<html>
<head>
  <title>ADMIN DASH</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>

    $(document).ready(function() {

        
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
 
  <!-- SHOW THE LIST OF USER -->
  <div >
    <button id="ShowUser">Click me!</button>
    <!-- <input id= type="submit" value="Showuser"> -->
    <div id="ShowUserResult"></div> 
  </div>
    
    
  <!-- HERE ALL THE ERROR WILL GO -->
  <div id="error"></div>

</body>
</html>
