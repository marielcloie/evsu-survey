<!DOCTYPE html>
<html lang="en" >
<head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/header.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin_pads.css') ?>">
  <script src="<?php echo base_url('assets/bootstrap/js/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>


</head>

 <body>
  <div class="container-fluid">
    <div class="row" id="forheader" align="left">   
      <img src="<?php echo base_url('image/untitled.png'); ?>";>
    </div>
      <div class="container">
            <div class="col-sm-8 col-xs-12" >
            <br><br><br>
            <nav class="navbar" role="navigation">
             <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse"
             data-target="#example-navbar-collapse">
             <span class="sr-only">Toggle navigation</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
            </button>
            </div>

             <div class="collapse navbar-collapse" id="example-navbar-collapse" >
              <ul class="nav nav-justified">
                <?php if ($_SESSION['usertype']=="Instructor"): ?>
                  <li><a href="<?php echo base_url('instructor') ?>"><b>HOME</b></a></li>   
                <?php endif ?>
                <?php if ($_SESSION['usertype']=="Student"): ?>
                  <li><a href="<?php echo base_url('student') ?>"><b>HOME</b></a></li>   
                <?php endif ?>
                <?php if ($_SESSION['usertype']=="Instructor"): ?>
                  <li><a href="<?php echo base_url('instructor/viewprofile') ?>"><b>PROFILE</b></a></li>
                <?php endif ?>
                <?php if ($_SESSION['usertype']=="Student"): ?>
                  <li><a href="<?php echo base_url('student/viewprofile') ?>"><b>PROFILE</b></a></li>   
                <?php endif ?>
                <li><a href="<?php echo base_url('users/notification') ?>"><b>NOTIFICATIONS</b></a></li>
                <li><a href="#"><b>ABOUT US</b></a></li>
              </ul>
            </div>
           </nav>
           </div>


          <div class="col-sm-4 hidden-xs" align="right" >
            <button class="dropdown" id="loggedin" >
              <img id="profilepicture" src="<?php echo base_url('image/login.png'); ?>">
              <div class="dropdown-content">
                <a href="<?php echo base_url('users/changepassword'); ?>"><b>Change password</b></a>
                <a href="<?php echo base_url('users/logout'); ?> " onclick="if(!confirm('Are you sure you want to Logout?')) return false;"><b>Logout</b></a>
              </div>
            </button>
          </div>
      </div>
  </div>
</body> 

  
</html>

