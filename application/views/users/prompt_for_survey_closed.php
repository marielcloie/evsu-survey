  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">

  <script src="<?php echo base_url('assets/bootstrap/js/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
 
<title>EVSU Online Survey and Data Analysis Portal</title>

<body style="background-color: maroon; ">
	

<div class="container" align="center">
	<div class="row" >
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<p style="padding:100px;"></p>
			<?php if (!empty($message)): ?>
					<div class="col-sm-12 alert alert-<?php echo $message['status']; ?>">
						<b><?php echo $message['message']; ?></b>
					</div>	
			<?php endif ?>
			<form action="" method="POST">
				<input type="password" name="password" class="form-control" placeholder="Enter Password"><br>
				<input type="submit" class="btn btn-block" name="Submit">
			</form>			
		</div>
		<div class="col-sm-4"></div>
	</div>	
</div>
</body>