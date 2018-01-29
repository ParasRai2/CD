
<?php
	include_once("conn.php");
	$name="";
	$email="";
	if(isset($_POST['uname']) && isset($_POST['email']))
	{
		$name=$_POST['uname'];
		$email=$_POST['email'];
		$query="SELECT `Name`, `Email`, `Password` FROM `account`";
	    $values=mysqli_query($conn,$query);
	    $admin=false;
		while ($row=mysqli_fetch_array($values)) {
			if($name=="Admin")
			{        
				if($email==$row['Email'])
					$admin=true;
				break;
			}
		}
		$query="SELECT * FROM `detail`";
	    $values=mysqli_query($conn,$query);
		while ($row=mysqli_fetch_array($values)) 
		{
			$c=$row['Name'];
		}
	}
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
	#body{

}

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
						<li><a href="index.php" title="Home Page">Home <span class="glyphicon glyphicon-home"></span> </a></li>
						<li class="active" title="Gallery Page(Activated)"><a> Gallery <span class="glyphicon glyphicon-film"></span> </a></li>
						<li onclick="clkabt()" title="About Page"><a> About <span class="glyphicon glyphicon-user"></span> </a></li>
						<li onclick="clkcont()" title="Contact Page"><a> Contact <span class="glyphicon glyphicon-phone-alt"></span> </a></li>
					</ul>
					<ul class='nav navbar-nav navbar-right'>
						<?php
							if(($_POST["uname"])!="")
							{
								$name=$_POST['uname'];
								$email=$_POST['email'];
								if ($admin) {									
									echo "<li onclick='clkaddgal()'><a>Add Gallery</a></li>";
								}
								echo "<li><a>".$name."</a></li>";
							}
							else
								echo "<li><a href='index.php'>Please Log In</a></li>";

						?>
					</ul>
				</div>	
				<div class="progress-container">
			   		<div class="progress-bar" id="myBar"></div>
				</div>  
			</nav>

			
		</div>


<style type="text/css">
	#galbody{
		box-shadow: 0px 0px 20px blue;
		border-radius: 5px;
		padding: 0px;
		text-align: center;
	}
</style>
		<div class="container" id="galbody">
			<style type="text/css">		
				.imgboxx{
					cursor: pointer; 
					height: 250px; 
					margin: 3px;
				}
			</style>
			<div class='container-fluid' style="margin-bottom: 10px; margin-top: 10px;">
				<?php

					$sn=0;
					$query="SELECT * FROM `gallery` ORDER BY `SN` DESC";
					$value=mysqli_query($conn,$query);
					while ($row=mysqli_fetch_array($value)) {
						echo "<div class='col-md-4 col-sm-6'>";
							echo "<div class='container-fluid' style='margin:3px; padding: 5px; border-radius:7px; box-shadow: 0px 0px 8px red inset;'>";
								$sn++;
								echo "<div class='row'>";
									echo "<h3 style='color: red; font-family: Verdana;'>$row[title]</h3>";
								echo "</div>";
								
								echo "<div class='row'>";
									echo "<div style='color: blue;'>";
										echo "$row[detail]";
									echo "</div>";
								echo "</div>";

								echo "<div class='row' style='margin-top:20px; margin-left:10px; margin-right:10px;'>";
										echo "<a href='Gallery/$row[photo]'><img src='Gallery/$row[photo]' class='imgboxx img-thumbnail img-responsive'></a>";
								echo "</div>";
								if($admin){
									echo "<div class='row'><button class='btn btn-link' style='color: red;' onclick='del($row[SN])'>Delete</a></div>";
								}
							echo "</div>";
						echo "</div>";
					}

					if($sn==0)
					{
						echo "<span><h4 style='color: red;text-shadow: 2px 2px #ffff00;'>No Gallery Found!!</h4></span>";
					}
				?>
					
			</div>
			
		</div>




		<form action="about.php" method="post" id="af">
			<input type="hidden" name="uname" value="<?php echo $name; ?>">
			<input type="hidden" name="email" value="<?php echo $email; ?>">
		</form>
		<form action="contact.php" method="post" id="cf">
			<input type="hidden" name="uname" value="<?php echo $name; ?>">
			<input type="hidden" name="email" value="<?php echo $email; ?>">
		</form>


<style type="text/css">
	.form{
		position: fixed;
		z-index: 100;
		width: 100%;
		height: 100%;
		padding: 40px;
		display: none;
		background-color: rgba(1,1,1,.5);
		top: 0px;  
		overflow: auto;
	}
	.imgbox{
		cursor: pointer; 
		height: 200px; 
		width: 200px; 
		margin: 3px;
	}
</style>
<script type="text/javascript">
			function fclose(){
				document.getElementById("addgallery").style.display='none';
			}
			function cphoto(a){
				var b= "g"+a;
				document.getElementById(b).click();
			}
			function clearall(){
				var a=1;
				while(a<=6)
				{
                	var x='photothumb'+a;
                	var y='g'+a;
                	var output = document.getElementById(x);
                	output.src = "background/add.png";
                	document.getElementById(y).value="";
                	a++;
				}
			}
            var loadFile = function(event,a) {
                var x='photothumb'+a;
                var output = document.getElementById(x);
                output.src = URL.createObjectURL(event.target.files[0]);
            };
</script>


		<div class="form" id="addgallery">
			<div class="col-xs-8 col-xs-offset-2 col-sm-4  col-sm-offset-4" style="text-align: center; background-color: white; border-radius: 5px; padding: 20px;">
				<form action="addgallery.php" method="post" enctype='multipart/form-data'>
					<div class="form-group">
						<label for="title">Add Gallery</label>
					</div>
					<div class="form-group">
					    <label for="title">Title</label>
					    <input type="text" class="form-control" name="title" placeholder="Enter Title" style="text-align: center;" required>
					</div>
					<div class="form-group">
					    <label for="detail">Detail</label>
					    <textarea class="form-control" name="detail" placeholder="Enter Detail" style="text-align: center; resize: none; height: 80px;" required></textarea>
					</div>
					<div class="form-group" style="display: none;">
						<input type="hidden" name="uname" value="<?php echo $name; ?>">
						<input type="hidden" name="email" value="<?php echo $email; ?>">
					    <input type="file" id="g1" name="g1" accept="image/*" size="25" onchange='loadFile(event,1)'>
					</div>
					<div class="form-group">
					    <label for="files">Select Files</label><br/>
						<div class="row">
						    <img onclick='cphoto(1)' src="background/add.png" id="photothumb1" class="img-rounded imgbox">
						</div>
					</div>
					<button type="submit" class="btn btn-info">Save</button>
					<button type="reset" onclick="clearall()" class="btn btn-primary">Clear All</button>
					<button type="button" onclick="fclose()" class="btn btn-danger">Close</button>
				</form>
			</div>
		</div>


		<form action="delgal.php" method="post" id="delgal">
			<input type="hidden" name="uname" value="<?php echo $name ?>">
			<input type="hidden" name="email" value="<?php echo $email ?>">
			<input type="hidden" name="sn" id="sn">
		</form>

		<script type="text/javascript">
			function del(a){
				document.getElementById("sn").value=a;
				document.getElementById("delgal").submit();
			}
		</script>


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

			function clkabt(){
				document.getElementById("af").submit();
			}
			
			function clkcont(){
				document.getElementById("cf").submit();
			}

			function clkaddgal(){
				document.getElementById("addgallery").style.display="block";
				var a=1;
				while(a<=6)
				{
                	var x='photothumb'+a;
                	var output = document.getElementById(x);
                	output.src = "background/add.png";
                	a++;
				}
			}
		</script>

	</body>

</html>