<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>
                Network Connection
            </title>
            <link href=images/titleLogo.jpg rel="icon" type="image/png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="style/style.css" rel="stylesheet" type="text/css" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
            <?php
                //taking input from http
                if(isset($_POST["submit"])) {
                    $n = $_POST["username"];
                    $p=$_POST["password"];
                    $cp=$_POST["confirmPass"];
                    $key=true;
                        
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
                        $sql_u ="SELECT id FROM users WHERE name= '$n'";
                        $res_u = mysqli_query($conn,$sql_u);
                        if(mysqli_num_rows($res_u) > 0){
                            echo "Already Registered";
                        }
                    else{
                        if($p==$cp){
                            $sql="INSERT INTO users(name,password) VALUES('$n','$p')";
                            if(mysqli_query($conn,$sql)){
                                echo "Successfully Registered";
                            }
                            else{
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                            mysqli_close($conn);
                        }
                        else{
                            echo "Password and Confirm password do not match";
                        } 
                        }
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
                           <!--Button to collapse items in it-->
                           <button class="navbar-toggler" data-toggle="collapse" data-target="#navData">
                            <spam class="navbar-toggler-icon" ></spam>
                        </button>
                        <!--Content in the navbar-->
                        <div class="collapse navbar-collapse" id="navData">
                            <ul class="navbar-nav ml-auto" >
                                    <li class="nav-item">
                                         <a href="login.php" class="nav-link" id="textColor">Login</a>
                                    </li>
                            </ul>
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
                    <!--<form method="POST" action="signup.php"> -->
                        <h2 class="text-center">REGISTER</h2>
                         <div class="input-container">
                                <i class="fa fa-user icon"></i>
                             <input type="text"  name="username" placeholder="Enter User Name" class="input-field" required >
                           
                        </div>


                        <div class="input-container">
                            <i class="fa fa-key icon"></i>
                            <input type="password" name="password" placeholder="Enter Password" class="input-field" required>
                           
                        </div>
                        <div class="input-container">
                            <i class="fa fa-key icon"></i>
                             <input type="password"  name="confirmPass" placeholder="Confirm Password" class="input-field" required >
                        </div>
                        <div class="row" id="button">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                <button type="submit" class="btn btn-default" name="submit"><span style="color:#ff3366;"><h5>Submit</span></h5></button>
                                </form>
                                </div>
                                </div>
                    
                </div>
       
        </div>
            </div>
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>      
    </body>
</html>