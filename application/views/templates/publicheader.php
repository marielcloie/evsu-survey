<!DOCTYPE html>
<html lang="en" >

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/header.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/styles.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login.css') ?>">
  <script src="<?php echo base_url('assets/bootstrap/js/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/automatic-dash.js') ?>"></script>
  

  <body>
  <div class="container-fluid">
    <div class="row" id="forheader" align="left">   
      <img src="<?php echo base_url('image/untitled.png'); ?>";>
    </div>
      <div class="container">
            <div class="col-sm-6 col-xs-12" >
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
                <li><a href="<?php echo base_url() ?>"><b>HOME</b></a></li>
                <li><a href="<?php echo base_url('users/about_us') ?>"><b>ABOUT US</b></a></li>
              </ul>
            </div>
           </nav>
           </div>


          <div class="col-sm-6 hidden-xs" align="right" >
            <button id="login" data-toggle="modal" data-target="#login-modal" ><span class="glyphicon glyphicon-log-in"></span><b> LOG IN</b></button>
          </div>
      </div>
  </div>
</body> 

<<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="loginmodal-container">
         <h1><font color="#FFBD04">Login to Your Account</font></h1><br>
         <form action="<?php echo base_url('users/login') ?>" method="POST">
        <input class="form-control"  type='text'  id="idNo"  placeholder="x x x x - x x x x x" name='id_no' style="background-color: white;"   maxlength='10'>
         <input type="password" name="password" placeholder="Password" required>
         <input type="submit" class="login loginmodal-submit" value="LOGIN">
         </form>
       </div>
     </div>
</div>

</html>

