<?php $this->load->view('common/header'); ?>

            
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 mb-3 text-center">
                  <h3>
                    Dashboard
                    <hr>
                  </h3>
                </div>
              </div>
                <div class="row g-5">

                    <!-- card1  -->
                    <div class=" col-sm-12 col-md-6 col-lg-3 animate__animated animate__pulse">
                        <div class="card card-sd">
                            <div  class="card-body d-flex justify-content-around">
                              <h5 class="card-title mt-3">Total views</h5>
                              <span class="fw-bold p-3">200</span>
                            </div>
                          </div>
                     </div>
                       <!-- card1  -->

                         <!-- card2  -->
                     <div class="col-sm-12 col-md-6 col-lg-3 animate__animated animate__pulse ">
                        <div class="card card-sd">
                            <div class="card-body d-flex justify-content-around">
                              <h5 class="card-title">Total Donated items</h5>
                              <span class="fw-bold p-3">
                                <?=$products;?>
                              </span>
                            </div>
                          </div>
                     </div>
                       <!-- card2  -->

                         <!-- card3  -->
                     <div class="col-sm-12 col-md-6 col-lg-3 animate__animated animate__pulse">
                        <div class="card card-sd">
                            <div class="card-body d-flex justify-content-around">
                              <h5 class="card-title mt-3">Total no of users</h5>
                              <span class="fw-bold p-3">
                                <?=$users;?>
                              </span>
                            </div>
                          </div>
                     </div>
                       <!-- card3  -->

                         <!-- card4  -->
                     <div class="col-sm-12 col-md-6 col-lg-3 animate__animated animate__pulse">
                        <div class="card card-sd">
                            <div class="card-body d-flex justify-content-around">
                              <h5 class="card-title">Total no of products deleted</h5>
                              <span class="fw-bold p-3">
                                <?=$products_deleted;?>
                              </span>
                            </div>
                          </div>
                     </div>
                       <!-- card4  -->


    <!-- chart for no of daily users -->

<div  class="col-mb-12 col-lg-4 mt-5 mb-3 rounded background-animation-chart p-3">
  <h4 class="text-center">No of Daily Login users</h4>
  <canvas  id="myChart"></canvas>
</div>
<!-- chart for no of daily users -->

<!-- chart for No of Products given daily -->
<div  class="col-mb-12  col-lg-4 mt-5 mb-3 rounded background-animation-chart p-3">
<h4 class="text-center">No of Products given daily</h4>
<canvas  id="myChart2"></canvas>
</div>
<!-- chart for No of Products given daily -->

<!-- chart No of daily visitors -->
<div  class="col-mb-12 col-lg-4 mt-5 mb-3 rounded background-animation-chart p-3">
  <h4 class="text-center">No of daily visitors</h4>
  <canvas  id="myChart3"></canvas>
  </div>
  <!-- chart No of daily visitors -->


        </div>
      </div>

<?php $this->load->view('common/footer'); ?>