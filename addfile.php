
<?php
	include_once("conn.php");
	$name="";
	$admin=false;
	if(isset($_POST['uname']))
	{
		$name=$_POST['uname'];
		$email=$_POST['email'];
		$query="SELECT `Name`, `Email`, `Password` FROM `account`";
	    $values=mysqli_query($conn,$query);
		while ($row=mysqli_fetch_array($values)) {
			if($row['Name']=="Admin")
			{        
				if($email==$row['Email'])
					$admin=true;
				break;
			}
		}
	}
	$query="SELECT * FROM `detail`";
    $values=mysqli_query($conn,$query);
	while ($row=mysqli_fetch_array($values)) 
	{
		$c=$row['Name'];
	}
	mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Paras Rai</title>
	    <meta charset="utf-8"/>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.css" type="text/css" >
		<link rel="stylesheet" href="style/style.css"  type="text/css">

	</head>
<style type="text/css">


.head{
	background-color: lightblue;
	padding: 12px;
}
.headtext{
	color: blue;
	font-family: Comic Sans Ms;
	padding: 12px;
	width:auto;
	text-align: center;
	font-size: 17px;
	border-radius: 10px;
	border: 2px solid red;
	margin-right: 10px;
	margin-left: 5px;
}
.text{
	font-family: Comic Sans MS;
	text-align: center;
	font-style: bold;
	font-size: 30px;
	color: red;
}
.a{
	cursor: pointer;
	color: white; !important
}
.headtext{
	margin-top: auto;
	margin-bottom: auto;
}
#navbar{
	color: red;!important
	border: 2px solid lightblue;
}
.nav.navbar-nav .acive{
	color: white;
}
.nav.navbar-nav li a {
	font-family: Verdana;
   	color: red;
 }

.progress-container {
  width: 100%;
  height: 8px;
  background: #ccc;
}

.progress-bar {
  height: 8px;
  background: #4caf50;
  width: 0%;
}
.sticky {
  position: fixed;
  top: 0;
  z-index: 100;
  width: 100%;
}            
.form-control{
	text-align: center;
	color: black;
}
</style>
	<body>

		<div class="head container-fluid">
			<div class="text">
				Welcome to  My personal blog
			</div>
		</div>

		<div class="container-fluid" id="navbar">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					<a data-toggle="tooltip" title="My facebook"><div class="headtext col-xs-5" > <?php echo $c; ?> </div></a>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
					  	<span class="glyphicon glyphicon-list"></span>
					</button>
				</div>	
				<div class="collapse navbar-collapse" id="menu">
					<ul class="nav navbar-nav">
						<li><a href="index.php">Home <span class="glyphicon glyphicon-home"></span> </a></li>
					</ul>
				</div>	
				<div class="progress-container">
			   		<div class="progress-bar" id="myBar"></div>
				</div>  
			</nav>
		</div>

		<div class="container" style="padding:10px;text-align: center;">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">
					<div class="form" id="signup"  style="border:2px solid darkred; border-radius: 5px; padding: 10px;">
						<form action="uploadfile.php" method="post" enctype='multipart/form-data'>
							<div class="form-group">
								<label for="title">Add File</label>
							</div>
							<div class="form-group">
							    <label for="name">Enter Name</label>
							    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
							</div>
							<div class="form-group">
							    <label for="pwd">Detail</label>
							    <textarea class="form-control" id="detail" name="detail" placeholder="Enter Detail" style="height: 100px; resize: none;" required></textarea>
							</div>
							<div class="form-group">
							    <label for="name">Choose File</label>
							    <input type="file" class="form-control" name="fileToUpload">
							</div>
							<style type="text/css">
								option{
									text-align: center;
								}
							</style>
							<div class="form-group">
							    <label for="type">Select Upload Type</label>
							    <select class="form-control" name="type">	    	
							        <option>Software</option>
							        <option>MobileApps</option>
							        <option>Antivirus</option>
							    </select>
							</div>
							<input type="hidden" name="uname" value="<?php echo $name; ?>">
							<input type="hidden" name="email" value="<?php echo $email; ?>">
							<input type="hidden" name="dtype" value="<?php echo $_POST['type']; ?>">
							<button type="submit" class="btn btn-primary" title="Click to Upload">Upload</button>
						</form>
					</div>
				</div>
			</div>

		</div>

	  	<script src="js/jquery.js"></script>
	  	<script src="js/bootstrap.js"></script>


	  	<script type="text/javascript">
	  		
			window.onscroll = function() {myFunction()};

			var navbar = document.getElementById("navbar");
			var sticky = navbar.offsetTop;

			function myFunction() {
			  	if (window.pageYOffset >= sticky) {
			    	navbar.classList.add("sticky")
			 	} 
			 	else {
			    	navbar.classList.remove("sticky");
			  	}
			  	var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
			  	var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
				var scrolled = (winScroll / height) * 100;
				document.getElementById("myBar").style.width = scrolled + "%";
			}

	  	</script>
	</body>

</html>