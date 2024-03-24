<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="<?=ASSETS_PATH ?>/fontawesome-free-5.15.4-web/css/all.css">
    <script src="<?=ASSETS_PATH ?>fontawesome-free-5.15.4-web/js/solid.js">
    </script>
    <script src="<?=ASSETS_PATH ?>fontawesome-free-5.15.4-web/js/fontawesome.js"></script>
    <link rel="stylesheet" href="<?=ASSETS_PATH ?>css/style3.css">

    <title>Share Get - Admin</title>
</head>
<body style=" background: #c8d8e4;">
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reset Password </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?php echo base_url('login/change_password')?>" method="post">
        <div class="modal-body">
          <input type="password" name="old_password" placeholder="Old-Password" class="form-control" required>
          <input type="password" name="new_password" placeholder="New-Password" class="form-control mt-3" required>

        </div>
        <div class="modal-footer">
          <a class="btn btn-danger" data-bs-dismiss="modal">Close</a>
          <button type="submit" class="btn btn-success">Save changes</button>
        </div>
        </form>
      </div>
    </div>
</div>

    <div  class="container mt-5">
    <?php echo $this->session->flashdata('message'); ?>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="mb-3 text-center">
                    <h3>Admin Login</h3>
                </div>
                <form style=" background: white" action="<?php echo base_url('login')?>" method="post" class="shadow p-4">                  
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                    </div>
    
                    <div class="mb-3">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" name="password" id="Password" placeholder="Password" required>
                    </div>
    
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
    
                    <hr>
    
                    <p class="text-center">
                        <a href="#" class=" text-decoration-none"  data-bs-toggle="modal" data-bs-target="#exampleModal">Reset Password ?</a>
                    </p>
                    
                    
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="<?=ASSETS_PATH ?>js/jquery-3.5.1.js"></script>
    <script type="text/javascript">
        // Mano Mahe
        $('.alert').delay(3600).fadeOut(300);
        function closeshownAlert(){
          $('.alert').hide();
        }
    </script>
  </body>
</html>