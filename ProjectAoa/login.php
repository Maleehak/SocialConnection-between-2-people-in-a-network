<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>
                Network Connection
            </title>
            <link href="images/titleLogo.jpg" rel="icon" type="image/png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="style/style.css?version=51" rel="stylesheet" type="text/css" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
    <?php 

    if(isset($_POST["submit"])) {
    $n = $_POST["username"];
    $p=  $_POST["password"];
    $key;
 //take db data
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname="socialnetwork";
 
 // Create connection
    $conn = mysqli_connect($servername, $username, $password,$dbname);
 
 // Check connection
    if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
  }
 else{
     $key = mysqli_query($conn,"SELECT id FROM users WHERE name='$n' and password='$p'")->fetch_object()->id;
             if($key){
                  $_SESSION['name'] = $n;
                  $_SESSION['id'] = $key;
                  echo "Login Successfully";
                  echo "<a href='bfs_algorithm.php'>Show Profile</a>";        
             }
              else{
                 echo "User not found";
             }
             mysqli_close($conn);
        }
    }
    ?>
            <div class="bg">
                <nav class="navbar navbar-expand-md sticky-top navbar-dark" id="customColor" >
                    <!--Title of the page in navbar-->
                    <div class="navbar-brand" id="textColor">
                        
                       <h5 class="h5">
                            <img src="images/logo.jpg" width="25vh">
                        Connection Between Two People in a Network
                       </h5> 
                    </div>
                </nav>
           

        <div class="container">
            <div class="row">
                <div class="col-md-6"  id="image">
                    <img src="images/connection.jpg" width="450vh" height="450vh">
                </div>
                <div class="col-md-6">
                    <div class="form-outer"> 
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <h2 class="text-center">Login</h2>
                         <div class="input-container">
                                <i class="fa fa-user icon"></i>
                             <input type="text"  name="username" placeholder="Enter User Name" class="input-field" required >
                           
                        </div>

                        <div class="input-container">
                            <i class="fa fa-key icon"></i>
                            <input type="password" name="password" placeholder="Enter Password" class="input-field" required>
                           
                        </div>
                        <div class="row" id="button">
                        <div class="col-md-6">
                        <h6 class="h6 mr-3 mt-3">Not Registered yet? <br><a href="signup.php" style="color: #ff3366" >Register Now</a></h6>
                        </div>
                        <div class="col-md-6">
                        <button type="submit" class="btn btn-default"  name="submit"><span style="color:white"><h5>Login</span></h5></button>
                        </div>
                        </div>
                    </form>
                </div>
       
        </div>
            </div>
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>      
    </body>
</html>