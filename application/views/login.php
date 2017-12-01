<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sample.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assests/bootstrap/css/bootstrap.min.css') ?>">
  
  
</head>
<body>
  <div class="container-fluid" style="background-color: maroon; height: 400px">
      <div class="row" >
        <div class="col-sm-4"></div>
        <div class="col-sm-4" align="center">
         <form  action="" method="POST">
                <div class="form-group"><br>
                <img width="60%" height="120" style="border-radius: 10px" src="<?php echo base_url('image/login.png') ?>"><br><br>
                <div class="col-sm-2"></div>
                <div class="col-sm-8" align="center">
                <input class="form-control"  type='text'  id="idNo"  placeholder="USERNAME" name='id_no' style="background-color: white;"   maxlength='10'>
                <br>
                <input class="form-control"   placeholder="PASSWORD" type="password" name="password" ><br>
                <button class="btn btn-success" style="width: 100%" type="submit">Login</button>
                <br><br>
                </div> 
              </div>
          </form>
        </div>
        <div class="col-sm-4"></div>
      </div>
    </div>
  </body>  
</html>



