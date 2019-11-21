<html>
<head>

</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="socialnetwork";

//create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// check connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
    $n = "SELECT id and name FROM users";   
}
?>

</body>
</html>