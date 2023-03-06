<?php 
    session_start(); 
    include('includes/config.php'); // include php file thats connects the dtabase with our system
    
    $msg="";
    if(isset($_POST['submit'])){ //if isset is checking if the button type submit on line 68 is pressed to submit the html form
        $username=mysqli_real_escape_string($con,strtolower($_POST['username'])); //asigning our variables with data we we fetched from our login form with escape_string to escapes special characters in a string for use in an SQL query
        
        $password=mysqli_real_escape_string($con,$_POST['password']); 
        
        $login_query="SELECT * FROM `user` WHERE username='$username' and cust_password='$password'"; // fetching data entered by user from our database
        
        $login_res=mysqli_query($con,$login_query); //running SQL query
        if(mysqli_num_rows($login_res)>0){ //if the above query return something higher than 0 that means the username and password is correct so the user will be logged in
            $_SESSION['username']=$username; // asign our session with the username that has logged in
            header('Location:index.php'); //redirect the logged user to home page
        } 
        else{ //if the SQL query returns 0 that means the info provided by user doesnt correspong with any data on our database so something maybe wrong between username or password or both
             $msg= '<div class="alert alert-danger alert-dismissable" style="margin-top:30px";>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Unsuccessful!</strong> Login Unsuccessful.
                  </div>';
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
</head>
<body> 
  <?php include 'navbar.php'; ?>
   
    
    <br>
    <div class="container"> 
     <div class="row">
       <div class="col-md-3"></div>
        <div class="col-md-6"> 
          <?php echo $msg; ?>
            <div class="page-header">
                <h1 style="text-align: center;">Login</h1>      
          </div> 
            <form class="form-horizontal animated bounce" action="" method="post"> <?php //login form ?>
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <br>
                
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <br> 
                
                <div class="input-group">
                  <button type="submit" name="submit" class="btn btn-success">Log in</button>
                  
                </div>

              </form>  
              <br> 
              <div class="input-group">
              
              </div>
              
        </div> 
        <div class="col-md-3"></div>
         
     </div>
         
   
    </div> 
    
   
    
</body>
</html>