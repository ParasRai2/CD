
<?php
	include ("conn.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Paras Rai</title>
	    <meta charset="utf-8"/>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.css" type="text/css" >
		<link rel="stylesheet" href="style/style.css"  type="text/css">
		<style type="text/css">
			
			.text{
				font-family: Comic Sans MS;
				text-align: center;
				font-style: bold;
				font-size: 30px;
				color: red;
			}
			form{
				background-color: white;
				border-radius: 8px;
				text-align: center;
				padding: 20px;
				color: black;
			}
			.imgbox{
				cursor: pointer; 
				height: 100px; 
				width: 100px; 
				margin: 3px;
			}

		</style>
	</head>
	<body>

		<div class="head container-fluid">
			<h2 class="text">
				Welcome to  First Setup  
			</h2>
		</div>

		<div class="container" style="padding:2px; text-align: center;">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">
					<div class="form" id="signup"  style="box-shadow:0px 0px 10px red inset; border-radius: 15px; padding: 10px;">
						<form action="savefirst.php" method="post" enctype='multipart/form-data'>
							<div class="form-group">
								<label for="title" style="font-size: 25px;">WelCome!!</label>
							</div>
							<div class="form-group">
							    <label for="name">Enter Name</label>
							    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
							</div>
							<div class="form-group">
							    <label for="name">Enter Email</label>
							    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
							</div>
							<div class="form-group">
							    <label for="name">Enter Password</label>
							    <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter Email" required>
							</div>
							<div class="form-group">
							    <label for="pwd">Detail</label>
							    <textarea class="form-control" id="detail" name="detail" placeholder="Enter Detail" style="height: 80px; resize: none;" required></textarea>
							</div>

							<div class="form-group">
								<label for="images">Select Images</label>
								<div style="display: none;">
								    <input type="file" id="g1" name="g1" accept="image/*" size="25" onchange='loadFile(event,1)' required>
								    <input type="file" id="g2" name="g2" accept="image/*" size="25" onchange='loadFile(event,2)' required>
								    <input type="file" id="g3" name="g3" accept="image/*" size="25" onchange='loadFile(event,3)' required>
								</div>
								<div class="row">
								    <img onclick='cphoto(1)' src="background/add.png" id="photothumb1" class="img-rounded imgbox">
							    	<img onclick="cphoto(2)" src="background/add.png" id="photothumb2" class="img-rounded imgbox">
							    	<img onclick="cphoto(3)" src="background/add.png" id="photothumb3" class="img-rounded imgbox">
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-success">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>

	  	<script src="js/jquery.js"></script>
	  	<script src="js/bootstrap.js"></script>
	  	<script type="text/javascript">

			function cphoto(a){
				var b= "g"+a;
				document.getElementById(b).click();
			}
	  		
            var loadFile = function(event,a) {
                var x='photothumb'+a;
                var output = document.getElementById(x);
                output.src = URL.createObjectURL(event.target.files[0]);
            };
	  	</script>
	</body>

</html>