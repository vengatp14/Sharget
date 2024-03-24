<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shareget</title>

 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/css/stylesheet.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
  
  <!-- Script -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 
 <!-- jQuery UI -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  
</head>
<body>
<?php include './db.php';?>
<?php
if ($_GET['login_id'] !== null && $_GET['is_deleted'] !== null) {
     $login_id = $_GET['login_id'];
     $status = $_GET['is_deleted'];
    echo $sql = "update tbl_users set is_deleted=$status where id=$login_id";
				if ($conn->query($sql) === TRUE) {
                    header("location:./admin.php");
				} else {
					echo "Error: ".$sql."<br>".$conn->error;
				}
}
?>
<section class="content mt-5">
      <div class="container-fluid">
      
      <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Username</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>password</th>
                    <th>status</th>
                    <th>Otp_token</th>
                    <th>Otp_status</th>
                    <th>is_delete</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php 
      
      $sql = "SELECT * FROM tbl_users";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { 
          ?>
              
              <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                      <?php echo $row['phone']; ?>
                    </td>
                    <td><?php echo $row['password']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['otp_token']; ?></td>
                    <td><?php echo $row['otp_status']; ?></td>
                    <td><?php echo $row['is_deleted']; ?></td>                    
                    <?php 
                    if($row['is_deleted'] == 1){
                      ?>
                      <td class="text-center">
                      <a href="admin.php?login_id=<?php echo $row['id']; ?>&is_deleted=0">
                      <i class="fa-solid fa-lock text-danger"></i></a>
                  </td>
                      <?php
                    }else{
                    ?>
                    <td class="text-center">
                      <a href="admin.php?login_id=<?php echo $row['id']; ?>&is_deleted=1">
                      <i class="fa fa-unlock text-success" aria-hidden="true"></i></a>
                  </td>
                    <?php } ?>
                  </tr>
        <?php
        }
      } 
      $conn->close();
            
            ?> 
               
                  </tbody>
                </table>
        </<div>
 </section>
</body>
</html>