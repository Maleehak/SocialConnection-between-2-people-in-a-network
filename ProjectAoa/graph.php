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
    $sql ="SELECT id from users";
    $result = mysqli_query($conn, $sql);  
    //conert database result into array
   $rows = [];
   while($row = mysqli_fetch_array($result)){
       array_push($rows,$row);
   }
   //convert php_array into javascript
    $json = json_encode($rows);  
}
?>
    <script>
        var vertices = <?= $json?>;
        console.log(vertices);
    </script>

</body>
</html>