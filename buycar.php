<?php
session_start();
include('includes/config.php');

    if(isset($_POST['buyBtn']))  // if button buybtn is clicked place an oreder
    {
        if(isset($_SESSION['username'])){

            $veh_id = $_POST['veh_id'];
            $brand_name = $_POST['brand_name'];
            $veh_price = $_POST['veh_price'];

            $username = $_SESSION['username'];

            $user_sql = "SELECT * FROM user
                         WHERE username = '$username'";
            $run_user   = mysqli_query($con,$user_sql);
            $get_user  = mysqli_fetch_array($run_user);
            $count_user = mysqli_num_rows($run_user);

            $user_id = $get_user['user_id'];
        
            $order_num = rand(10000,100000);
            $order_date =date("Y-m-d");
            $order_status = "pending";
          
          
                $sql ="INSERT INTO c_order ( order_num,   customer_id,  order_date,   veh_id,   brand_name,   veh_price,   order_status)
                    VALUE              ('$order_num','$user_id',   '$order_date','$veh_id','$brand_name','$veh_price','$order_status')";

                if(mysqli_query($con,$sql))
                {
                    echo" <script>alert('order was success');</script>
                    <script>window.open('my_order.php', '_self')</script>";
                }
                else{

                    echo" <script>alert('Sorry Something went wrong try again');</script>
                          <script>window.history.back()</script>";
                }
   
        }
        else{
            
            echo" <script>alert('Please login before you order');</script>
            <script>window.open('login.php', '_self')</script>";
        }
        
    }

    if(isset($_POST['wishlistBtn']))  // if button buybtn is clicked place an add to wishlist
    {
        if(isset($_SESSION['username'])){

            $veh_id = $_POST['veh_id'];
            $veh_model = $_POST['veh_model'];
            $brand_name = $_POST['brand_name'];
         
            $username = $_SESSION['username'];

            $user_sql = "SELECT * FROM user
                         WHERE username = '$username'";
            $run_user   = mysqli_query($con,$user_sql);
            $get_user  = mysqli_fetch_array($run_user);
            $count_user = mysqli_num_rows($run_user);

            $user_id = $get_user['user_id'];
        
            $wish_date =date("Y-m-d");
        
          
          
                $sql ="INSERT INTO wishlist ( user_id, veh_id,wish_date)
                    VALUE              ('$user_id','$veh_id','$wish_date')";

                if(mysqli_query($con,$sql))
                {
                    echo" <script>alert('$brand_name $veh_model Added to wishlist');</script>
                    <script>window.open('index.php', '_self')</script>";
                }
                else{

                    echo" <script>alert('Sorry Something went wrong try again');</script>
                          <script>window.history.back()</script>";
                }
   
        }
        else{
            
            echo" <script>alert('Please login before you add to wishlist');</script>
            <script>window.open('login.php', '_self')</script>";
        }
        
    }
  
?>

