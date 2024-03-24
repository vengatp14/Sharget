<?php 
if(empty($this->session->userdata('sgAdmin'))){
  redirect(base_url('login/logout'));
}
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- meta tags  -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="venkatesh ponraj">
    <!-- tittle and logo -->
    <title>Share Get Admin</title>
    <link rel="shortcut icon" href="<?=ASSETS_PATH ?>images/logo.png" type="image/x-icon">
    <!-- chart.js  -->
    <script src="<?=ASSETS_PATH ?>chart.js/Chart.js"></script>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="<?=ASSETS_PATH ?>boostrap/bootstrap.min.css">
    <link href="<?=ASSETS_PATH ?>boostrap/bootstrap5.min.css" rel="stylesheet">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?=ASSETS_PATH ?>css/style3.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="<?=ASSETS_PATH ?>scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="<?=ASSETS_PATH ?>fontawesome-free-5.15.4-web/css/all.css">
    <script src="<?=ASSETS_PATH ?>fontawesome-free-5.15.4-web/js/solid.js">
    </script>
    <script src="<?=ASSETS_PATH ?>fontawesome-free-5.15.4-web/js/fontawesome.js">
    </script>
    <!-- data table  -->
    <link rel="stylesheet" href="<?=ASSETS_PATH ?>datatable/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?=ASSETS_PATH ?>datatable/datatable.css">
    <link rel="stylesheet" href="<?=ASSETS_PATH ?>datatable/responsive.bootstrap.css">
    <!-- animate.style -->
    <link rel="stylesheet" href="<?=ASSETS_PATH ?>anime.css/animate.min.css" />
    <style>
      .dataTables_wrapper .dataTables_length select {
        border: 1px solid #aaa; 
        border-radius: 3px;
        padding: 5px;
        background-color: white;
        padding: 4px;
      }
      .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #aaa;
        border-radius: 3px;
        padding: 5px;
        background-color:white;
        margin-left: 3px;
      }
      .blink{
        animation: animate 1s linear infinite;
      }
      .notify-desc{
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
      }
      @keyframes animate{
       0%{
         opacity: 0.2;
       }
       50%{
         opacity: 1;
       }
       100%{
         opacity: 0.2;
       }
     }
     /* toggle button */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
/* toggle button */
    </style>
  </head>
  <body>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="wrapper">
      <!-- Sidebar  -->
      <nav id="sidebar">
        <div id="dismiss">
          <i class="fas fa-arrow-left"></i>
        </div>
        <div class="sidebar-header">
          <h3>Admin</h3>
          <?php $actClass=$this->uri->uri_string(); ?>
        </div>
        <ul class="list-unstyled components">
          <p>Share Get</p>
          <li class="<?php echo ($actClass=='home/profile') ? 'side-nav-active' : ''; ?>">
            <a href="<?=base_url('home/profile') ?>">
              <i class="fas fa-user"></i> &nbsp; My Profile </a>
          </li>
          <li class="<?php echo ($actClass=='home') ? 'side-nav-active' : ''; ?>">
            <a href="<?=base_url('home') ?>" data-toggle="collapse" aria-expanded="false">
              <i class="fas fa-house-user"></i> &nbsp; Home </a>
          </li>
          <li class="<?php echo ($actClass=='user') ? 'side-nav-active' : ''; ?>">
            <a href="<?=base_url('user') ?>">
              <i class="fas fa-users"></i> &nbsp;Users </a>
          </li>
          <li class="<?php echo ($actClass=='items') ? 'side-nav-active' : ''; ?>">
            <a href="<?=base_url('items') ?>">
              <i class="fas fa-th-list"></i> &nbsp; No of post live </a>
          </li>
          <li class="<?php echo ($actClass=='category') ? 'side-nav-active' : ''; ?>">
            <a href="<?=base_url('category') ?>">
              <i class="fas fa-folder-plus"></i> &nbsp; Create category </a>
          </li>
          <li class="<?php echo ($actClass=='report/items') ? 'side-nav-active' : ''; ?>">
            <a href="<?=base_url('report/items') ?>">
              <i class="fas fa-th-list fa-xs"></i>
              <i class="fas fa-bug fa-xs"></i> &nbsp; Reported items </a>
          </li>
          <li class="<?php echo ($actClass=='report/users') ? 'side-nav-active' : ''; ?>">
            <a href="<?=base_url('report/users') ?>">
              <i class="fas fa-users fa-xs"></i>
              <i class="fas fa-bug fa-xs"></i> &nbsp; Reported users </a>
          </li>
          <li class="<?php echo ($actClass=='report/deleted') ? 'side-nav-active' : ''; ?>">
            <a href="<?=base_url('report/deleted') ?>">
              <i class="fas fa-trash"></i> &nbsp; Deleted report </a>
          </li>
          <li class="<?php echo ($actClass=='user/blogs') ? 'side-nav-active' : ''; ?>">
            <a href="<?=base_url('user/blogs') ?>">
              <i class="fas fa-blog"></i> &nbsp; blog </a>
          </li>
          <li class="<?php echo ($actClass=='user/messages') ? 'side-nav-active' : ''; ?>">
            <a href="<?=base_url('user/messages') ?>">
              <i class="fas fa-comments"></i> &nbsp;User messages </a>
          </li>
          <li class="<?php echo ($actClass=='notify') ? 'side-nav-active' : ''; ?>">
            <a href="<?=base_url('notify') ?>">
              <i class="fas fa-comments"></i> &nbsp;Notifications </a>
          </li>
          <li>
            <a href="<?=base_url('login/logout') ?>">
              <i class="fas fa-sign-out-alt"></i> &nbsp; logout </a>
          </li>
        </ul>
      </nav>
      <!-- Sidebar  -->
      <!-- Page Content  -->
      <div id="content">
        <nav class="navbar navbar-expand-lg nav-shadow sticky-top">
          <div class="container-fluid bg-white">
            <h4 style="cursor: pointer;" class="navbar-brand" id="sidebarCollapse" >
              <i class="fas fa-bars fa-1x mx-3 color-inside-card"></i>
              <img src="<?=ASSETS_PATH ?>images/logo.png" width="188px">
            </h4>
            <div class="w-100 text-right p-3">
              <?php
                $notify_report = $this->db->get_where('tbl_notify_admin', array('is_seen'=>1, 'sent_for'=>'report'));
                  if($notify_report->num_rows() > 0){
              ?>
                <a href="javascript:void(0);" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#notify-report">
                  Report &nbsp; <i class="fa fa-bell blink"></i>
                </a>
              <?php }else{ ?>
                <a href="javascript:void(0);" class="btn btn-sm btn-secondary">
                  Report &nbsp; <i class="fa fa-bell"></i>
                </a>
              <?php }
                $notify_blog = $this->db->get_where('tbl_notify_admin', array('is_seen'=>1, 'sent_for'=>'blog'));
                  if($notify_blog->num_rows() > 0){
              ?>
                <a href="javascript:void(0);" class="btn btn-sm btn-primary ml-4" data-bs-toggle="modal" data-bs-target="#notify-blog">
                  Blog &nbsp; <i class="fa fa-bell blink"></i>
                </a>
              <?php }else{ ?>
                <a href="javascript:void(0);" class="btn btn-sm btn-secondary ml-4" data-target="#notify-blog" data-toggle="modal">
                  Blog &nbsp; <i class="fa fa-bell"></i>
                </a>
              <?php }
                $notify_msg = $this->db->get_where('tbl_admin', array('is_contacted'=>1));
                  if($notify_msg->num_rows() > 0){
              ?>
                <a href="<?=base_url('user/messages')?>" class="btn btn-sm btn-primary ml-4">
                  Messages &nbsp; <i class="fa fa-bell blink"></i>
                </a>
              <?php }else{ ?>
                <a href="javascript:void(0);" class="btn btn-sm btn-secondary ml-4">
                  Messages &nbsp; <i class="fa fa-bell"></i>
                </a>
              <?php } ?>
            </div>
          </div>
        </nav>

<!-- Modal notification-->
<div class="modal fade" id="notify-blog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Blog Notifications</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <?php
            if(isset($notify_blog) && $notify_blog->num_rows() > 0){
            foreach ($notify_blog->result() as $n) {
          ?>
            <div class="col-sm-12">
              <h6>
                <b><?php echo $n->title; ?></b>
                <small class="card-text float-end"> <?php echo date('m/d/Y', strtotime($n->created_at)); ?></small>
              </h6>
              <p class="notify-desc">
                <?php echo $n->description; ?>
              </p>
              <?php if ($n->sent_for=='blog'): ?>
                <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="showBlogNotification('<?=$n->id?>')">
                  View in Blog
                </a>
              <?php endif; ?>
              <hr>
            </div>
          <?php } } ?>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>

<div class="modal fade" id="notify-report" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Report Notifications</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <?php
            if(isset($notify_report) && $notify_report->num_rows() > 0){
            foreach ($notify_report->result() as $n) {
          ?>
            <div class="col-sm-12">
              <h6>
                <b><?php echo $n->title; ?></b>
                <small class="card-text float-end"> <?php echo date('m/d/Y', strtotime($n->created_at)); ?></small>
              </h6>
              <p class="notify-desc">
                <?php echo $n->description; ?>
              </p>
              <?php if ($n->type=='product'): ?>
                <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="showReportNotification('<?=$n->id?>', 'items')">
                  View in Reported Products
                </a>
              <?php elseif ($n->type=='user'): ?>
                <a href="javascript:void(0);" class="btn btn-sm btn-warning" onclick="showReportNotification('<?=$n->id?>', 'users')">
                  View in Reported Users
                </a>
              <?php endif; ?>
              <hr>
            </div>
          <?php } } ?>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>
<!-- Modal notification-->