<?php

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "u782549771_shareget";

//server
$servername = "localhost";
$username = "u782549771_admin_shareget";
$password = "Admin@123";
$dbname = "u782549771_shareget";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if ($conn === false) {
  die("Connection failed: " . $conn->connect_error);
  ?>
  <script>
    console.log("Not Connected successfully");
</script>
  <?php
}else{
?>
 <script>
    console.log("Connected successfully");
</script>
<?php
}
?>