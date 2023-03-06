<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>GAZOLO</title>
  <link rel="icon" href="images/.png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- animate CSS -->
  <link rel="stylesheet" href="css/animate.css">
  <!-- owl carousel CSS -->
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <!-- themify CSS -->
  <link rel="stylesheet" href="css/themify-icons.css">
  <!-- flaticon CSS -->
  <link rel="stylesheet" href="css/flaticon.css">
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="css/magnific-popup.css">
  <!-- swiper CSS -->
  <link rel="stylesheet" href="css/slick.css">
  <link rel="stylesheet" href="css/gijgo.min.css">
  <link rel="stylesheet" href="css/nice-select.css">
  <link rel="stylesheet" href="css/all.css">
  <!-- style CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  
  <?php  
  
        include("navbar.php"); 
        include('includes/config.php'); //include php file thats connects the dtabase with our system
       session_start();
   ?>

  <!-- breadcrumb start-->
  <section>
  
   
        <div class="container">
           
            <div class="row"><br><br>
            <h2>Your Wishlist</h2>
            <table class="table">


                <?php 
 
 if(isset($_SESSION['username']))
 {
    $username = $_SESSION['username'];

    $user_sql = "SELECT * FROM user
                 WHERE username = '$username'";
    $run_user   = mysqli_query($con,$user_sql);
    $get_user  = mysqli_fetch_array($run_user);
    $count_user = mysqli_num_rows($run_user);

    $user_id = $get_user['user_id'];

                    $query = "SELECT * FROM wishlist WHERE user_id  = '$user_id' ORDER BY wish_date DESC";
                    $run_query = mysqli_query($con, $query);
                    ?>
                    

                                                            <thead>
                                                                <tr>
                                                                
                                                                <th>Picture</th>
                                                                <th>Brand</th>
                                                                <th>Model</th>
                                                                <th>Color</th>
                                                                <th>Price</th>
                                                                <th></th>
                                                                <th></th>
                                                                
                                                                   
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            if(mysqli_num_rows($run_query) > 0)
                                                            {
                                                                
                                                                while($row = mysqli_fetch_assoc($run_query))
                                                                {
                                                       
                                                                      $veh_id = $row['veh_id'];
                                                                      $veh_sql = "SELECT * FROM vehicle
                                                                                  WHERE veh_id = '$veh_id'";
                                                                      $run_veh   = mysqli_query($con,$veh_sql);
                                                                      $get_veh   = mysqli_fetch_array($run_veh);
                                                                
                                                                      $brand_id = $get_veh['veh_brand_id'];

                                                                      $brand_sql = "SELECT * FROM brand
                                                                                  WHERE brand_id = '$brand_id'";
                                                                      $run_brand   = mysqli_query($con,$brand_sql);
                                                                      $get_brand   = mysqli_fetch_array($run_brand);



                                                                      $image = (!empty($get_veh['veh_photo'])) ? 'img/cars/'.$get_veh['veh_photo'] : 'img/cars/placeholder.jpg';
                                                                
                                                            ?>
                                                           
                                                                
                                                                <tr>
                                                                <div class="col-lg-12">
                          
                                                                <td><img src="<?php echo $image?>" width='30px' height='30px'></td>
                                                                <td><?php echo $get_brand['brand_name'] ?></td>
                                                                <td><?php echo $get_veh['veh_model'] ?></td>
                                                                <td><?php echo $get_veh['veh_color'] ?></td>
                                                                <td>R<?php echo $get_veh['veh_price'] ?></td>

                                                                <form method ="POST" action="buycar.php">
                                                                <td>
                                                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                                                      <button name ="buyBtn" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-cross"></span> Buy</a> </button>
                                                                    </div>  
                                                                    <input type="hidden" name="veh_id" value="<?php echo $get_veh['veh_id'] ?>">
                                                                    <input type="hidden" name="brand_name" value="<?php echo $get_brand['brand_name'] ?>">
                                                                    <input type="hidden" name="veh_price" value="<?php echo $get_veh['veh_price'] ?>">
                                                                  </td>
                                                                </form>
                                                                <form method ="GET" action="#">
                                                                <td>
                                                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                                                      <button name ="removeBtn" class="btn btn-danger btn-sm btn-flat"><span class="glyphicon glyphicon-cross"></span> Remove</a> </button>
                                                                    </div>  
                                                                    <input type="hidden" name="wishlist_id" value="<?php echo $row['wishlist_id'] ?>">
                                                                  </td>
                                                                </form>
                                                                    
                                                               
                                                                </tr>
                                                                
                                                                <?php

                                                                    }
                                                                    }else{
                                                                    echo "No car Found!";
                                                                    }

                                                                ?>
                                                            </tbody>
                                                            </table>
                                                            
                </div>
            </div>
      
            
        </div>
    </section>

    
</body>

</html>

<?php


if(isset($_GET['removeBtn']))
{
    
  $wishlist_id = $_GET['wishlist_id'];
    $delete_sql = " DELETE FROM wishlist WHERE wishlist_id = '$wishlist_id'";
            if(mysqli_query($con,$delete_sql))
            {
                echo" <script>alert('car removed');</script>
                      <script>window.history.back()</script>";
            }
            else
            {
                echo" <script>alert('sorry something went wrong try again!');</script>
                    <script>window.open('wishlist.php', '_self')</script>";
            }
}


?>

<?php   }else { 

echo "<script>alert('Please login!');</script>
<script>window.open('login.php', '_self')</script>";
}


?>