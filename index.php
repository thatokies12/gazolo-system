<?php 
   include('includes/config.php'); //include php file thats connects the dtabase with our system

   
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GAZOLO</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css"> 
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
     <!-- swiper CSS -->
     <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/gijgo.min.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/navbar.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>

 
</head> 
<style>
    

</style>
<body data-spy="scroll" data-target=".navbar" data-offset="50" onload="myFunction()"> 
   
   
 
       
           
       
        
    </div>     <div class="parallax foo">
       <?php include 'navbar.php';  //include navigation menu on our page from file navbar.php?>
    
        <div class="hero-text" style="font-size:50px text-align: center; position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);color: black;">
           
            
            <h1><a href="index.html" id="body" class="scrollto"><img src="img/logo2.png"></a></h1>
            <h4><a href="sellcar.html" id="body" class="scrollto"><span style="color: white;">want to sell your car?</span></a></h4> 
         
            <?php if(isset($_SESSION['username'])==true) { //check if the user logged in or not to change the buy button status ?>
            
            <a class="btn btn-info" style="text-align: center" href="sellcar.php">Sell a Car</a>
            
            <?php } else{  //if the user is not logged the button status will show that the user must login to purchase a car ?>
                <a class="btn btn-info" style="text-align: center" href="sellcar.php">Sell a Car</a> 
            <?php } ?>
            
          </div>
    </div>                 
    
<br><br>


    <div>
       <br><br>
        
       <div id="bannerImage">
               
            <div class="container">
              
                <div class="row">
                <form action="index.php" method="POST">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                <div class="white-box">
                     
                    <div class="form-group mb-3">
               
                        <label color="blue" for="brand_id">
                            Select Car Brand
                        </label><br>

                            <select class="form-control" id="brand_id" name="brand_id">
                                    <option value='' selected>All Brands*</option>
                                                
                                    <?php
                            
                                        $get_brand = "SELECT *
                                                    FROM brand ";
                                        $run_brand = mysqli_query($con, $get_brand);

                                        while($row_brand=mysqli_fetch_array($run_brand))
                                        {

                                            $brand_name = $row_brand['brand_name'];
                                            $brand_id = $row_brand['brand_id'];

                                            echo "
                                                <option value='$brand_id'> $brand_name </option>
                                                ";

                                        }
                                            
                                    ?>
                            </select>
                                            <script type="text/javascript">
                                                document.getElementById('brand_id').value = "<?php echo $_POST['brand_id']; ?>";
                                            </script><br>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <button class="btn btn-warning" name="filter">
                                                        filter brand
                                                        </button>
                                                    </div>
                                            </div>
                    </div>
                </div>
            </div>
        </div>

                                    
</form>
                    <table align="center" border="2px">

                        <?php 
        
                            
                            $num_per_page= 03;

                            if(isset($_GET["page"]))
                            {
                                $page=$_GET["page"];
                            }
                            else
                            {
                                $page=1;
                            }
                            $start_from=($page-1)*03; //minus 1 cause we starty at 0
                            $brand_id = FILTER_INPUT(INPUT_POST,'brand_id')?FILTER_INPUT(INPUT_POST,'brand_id'):"%";
                            $query = "SELECT * FROM vehicle
                                      WHERE veh_brand_id LIKE '$brand_id' limit $start_from,$num_per_page";
                            $run_query = mysqli_query($con, $query);
                            
                            
                            ?>
                            

                            <thead>

                                <tr></tr>

                                    </thead>
                                        <tbody>
                                            <?php
                                                if(mysqli_num_rows($run_query) > 0)
                                                {                                                                  
                                                    while($row = mysqli_fetch_assoc($run_query))
                                                {
                                                $brand_id = $row['veh_brand_id'];
                                                $brand_sql = "SELECT * FROM brand
                                                              WHERE brand_id= '$brand_id'";
                                                $run_brand   = mysqli_query($con,$brand_sql);
                                                $get_brand   = mysqli_fetch_array($run_brand);
                                            ?>

                                            <?php
                                                                    
                                                $image = (!empty($row['cover_pic'])) ? 'img/cars/'.$row['veh_photo'] : 'img/cars/placeholder.jpg';
                                            ?>
                                                                    
                                            <tr>
                                                <div class="col-md-6 col-lg-4">
                            
                                                    <form action="buycar.php" method="POST">
                                                        <div class="single_service_part">
                                                            <img src="img/cars/<?php echo $row['veh_photo'] ?> " width='300px' height='200px' alt="">
                                                                <div class="single_service_text">
                                                                    <h4><?php echo $get_brand['brand_name'] ?></h4>
                                                                    <h4><?php echo $row['veh_model'] ?></h4>
                                                                    <h5><?php echo $row['veh_color'] ?></h5>
                                                                    <h5><?php echo $row['veh_description'] ?></h5>
                                                                    <h3>R<?php echo $row['veh_price'] ?></h3>

                                                                    
                                                                    <input type="hidden" name="veh_model" value="<?php echo $row['veh_model'];?>">
                                                                    <input type="hidden" name="veh_color" value="<?php echo $row['veh_color'];?>">
                                                                    <input type="hidden" name="veh_description" value="<?php echo $row['veh_description'];?>">
                                                                    <input type="hidden" name="veh_photo" value="<?php echo $row['veh_photo'];?>">
                                                                    <input type="hidden" name="veh_id" value="<?php echo $row['veh_id'];?>">
                                                                    <input type="hidden" name="veh_price" value="<?php echo $row['veh_price'];?>">
                                                                    <input type="hidden" name="brand_name" value="<?php echo $get_brand['brand_name'];?>">
                                                                    <button type="submit" name="buyBtn" class="btn btn-success btn-flat" id="add"><i ></i> BUY</button>
                                                                    <button type="submit" name="wishlistBtn" class="btn btn-info btn-flat" id="add"><i ></i> add to wishlist</button>
                                                            
                                                                </div>
                                                        </div>
                                                </div>
                                                                
                                                    </form>
                                            </tr>
                                                                    <?php

                                                                        }
                                                                        }else{
                                                                        echo "No Car found!";
                                                                        }

                                                                    ?>
                                        </tbody>

                    </table>

                                      
                </div><br><br>

                                        <?php
                                            $veh_brand_id = FILTER_INPUT(INPUT_POST,'brand_id')?FILTER_INPUT(INPUT_POST,'brand_id'):"%";
                                            $car_sql = "SELECT * FROM vehicle
                                            WHERE veh_brand_id LIKE '$veh_brand_id'";
                                            $run_results = mysqli_query($con, $car_sql);
                                            $total_records = mysqli_num_rows($run_results);
                                            $total_pages = ceil($total_records/$num_per_page);
                                            
                                            if($page>1) 
                                            {
                                               echo "<a href='index.php?page=".($page-1)."' class='btn btn-primary'>PREVIOUS</a>";
                                            }
                                   
                                            for($i = 1; $i <= $total_pages + 1; $i++) 
                                            {
                                                if($page == $i)
                                                {
                                                    echo "<a href='index.php?page=".$i."' class='btn btn-success'>$i</a>";
                                                }
                                                else
                                                {
                                               
                                                    echo "<a href='index.php?page=".$i."' class='btn btn-primary'>$i</a>";
                                                }
                                            }
                                   
                                            if($i>$page) 
                                            {
                                               echo "<a href='index.php?page=".($page+1)."' class='btn btn-primary'>NEXT</a>";
                                            }

                                          
                                        ?><br><br>


            </div>
        
        </div>      
                
    </div>  
        
        <footer style="background-color: #2f2f2f;
          color: #fff; padding-top: 70px;
          padding-bottom: 70px;" class="container-fluid text-center">
                <p>All rights reserved</p> 
        </footer>
        
        
        
        
    
    
    
<script>
    $(function () {
  $(document).scroll(function () {
    var $nav = $(".navbar-fixed-top");
    $a= $(".parallax");
    $nav.toggleClass('scrolled', $(this).scrollTop() > $a.height());
  });
}); 
    
    </script>    
  
  
  <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
  
  
  <script>
        window.sr = ScrollReveal();
        sr.reveal('.foo', { duration: 800 });
        sr.reveal('.foo1', { duration: 800,origin: 'top'});
    </script>
    
</body>
</html>
