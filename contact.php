<?php 
session_start();
include('includes/config.php');
if(!isset($_SESSION['username'])){
  header('location: login.php');
}else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>GAZOLO</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="jquery-ui-datepicker/jquery-ui.min.css" type="text/css" />
    <!-- http://api.jqueryui.com/datepicker/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <?php include 'navbar.php' ?>
  </head>

  <body>

  <?php 
  $username = $_SESSION['username'];

  $seller_username = FILTER_INPUT(INPUT_POST,'seller_username')?FILTER_INPUT(INPUT_POST,'seller_username'):"%";
  $veh_reg = FILTER_INPUT(INPUT_POST,'veh_reg')?FILTER_INPUT(INPUT_POST,'veh_reg'):"%";

  $chat = "SELECT * FROM chat
  WHERE sender_username ='$username' ";
  $run_chat   = mysqli_query($con,$chat);
  $get_chat  = mysqli_fetch_array($run_chat);

  ?>
    <div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mx-auto">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12">
                <h2 class="tm-block-title d-inline-block">CHAT</h2>
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form action="contact.php" method="POST" class="tm-edit-product-form" enctype="multipart/form-data">
                
                <table class="table">

                    

                                                            <thead>
                                                                <tr>
                                                                
                                                                <th></th>
                                                                <th></th>
                                                      
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                        
                                                                      $veh_sql = "SELECT * FROM vehicle
                                                                                  WHERE veh_reg = '$veh_reg'";
                                                                      $run_veh   = mysqli_query($con,$veh_sql);
                                                                      $get_veh   = mysqli_fetch_array($run_veh);
                                                                      $sell_username = $get_veh['seller_username'];
                                                                
                                                                      /*$brand_id = $get_veh['veh_brand_id'];*/
                                                                     /* $brand_id = $row['veh_brand_id'];
                                                                      $brand_sql = "SELECT * FROM brand
                                                                                    WHERE brand_id = '$brand_id'";
                                                                      $run_brand   = mysqli_query($con,$brand_sql);
                                                                      $get_brand   = mysqli_fetch_array($run_brand);*/

                                                                      $username = $_SESSION['username'];

                                                                      $user_sql = "SELECT * FROM user
                                                                                   WHERE username = '$sell_username'";
                                                                      $run_user   = mysqli_query($con,$user_sql);
                                                                      $get_user  = mysqli_fetch_array($run_user);
                                                                      $count_user = mysqli_num_rows($run_user);
                                                                      //$sell_username = $get_user['username'];
                                                                      $user_id = $get_user['user_id'];

                                                                      $query = "SELECT * FROM vehicle WHERE seller_username  = '$username' ";
                                                                      $run_query = mysqli_query($con, $query);

                                                                      $full_name = $get_user['first_name']." ".$get_user['last_name'];

                                                                      $image = (!empty($get_user['profile_pic'])) ? 'img/profile/'.$get_user['profile_pic'] : 'img/cars/placeholder.jpg';
                                                                
                                                            ?>
                                                           
                                                                
                                                                <tr>
                                                                <div class="col-lg-12">
                          
                                                                <td><img src="<?php echo $image ?>" width='60px' height='60px' class='round-pp'></td>
                                                                <td>Send message to <?php echo $full_name ?></td>
                            
                                                                </tr>
                                                                
                                                                <?php

                                                                  
                                                                ?>
                                                            </tbody>
                                                            </table>

                  <div class="form-group mb-3">
                    <label
                      for="name"
                      >
                    </label>
                    <input
                      id="name"
                      placeholder="type message"
                      name="textmessage"
                      type="textarea"
                      rows="4" 
                     
                      class="form-control validate"
                      required
                    />
                    
                  </div>
                  <input type="hidden" name="veh_reg" value="<?php echo  $veh_reg?>">
                  <input type="hidden" name="seller_username" value="<?php echo  $seller_username?>">
                  <button type="submit" name="sendBtn" class="btn btn-primary btn-block text-uppercase">Send</button><br>
                    

              </div>
            
        
                
              
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="jquery-ui-datepicker/jquery-ui.min.js"></script>
    <!-- https://jqueryui.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
      $(function() {
        $("#expire_date").datepicker();
      });
    </script>
  </body>
</html>

<?php

 if(isset($_POST['sendBtn']))
 {

    $veh_reg = $_POST['veh_reg'];
    
    $message_date =date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $user_message = $_POST['textmessage'];
    $seller_username = $_POST['seller_username'];
    $placeholder ="placeholder.jpg";
   

            // checking if the email have a profile or not
            $checkcar = "SELECT * FROM vehicle
            WHERE veh_reg ='$veh_reg'";
            $run_car   = mysqli_query($con,$checkcar);
            $get_car  = mysqli_fetch_array($run_car);
            $count_car = mysqli_num_rows($run_car);
            $receiver_username = $get_car['seller_username'];
           

                        $sql = "INSERT INTO chat ( sender_username,   receiver_username ,   message_date ,  user_message)
                                VALUES            ('$username',      '$seller_username', '$message_date','$user_message')";

                        if(mysqli_query($con,$sql))
                        {
                          echo" <script>alert('message sent');</script>
                          <script>window.open('my_order.php', '_self')</script>";
                        }
                        else
                        {
                            echo" <script>alert('something went wrong');</script>
                                <script>window.history.back()</script>";
                        }
         
 }
}
?>
