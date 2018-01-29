
<?php
	include_once("conn.php");
	$name="";
	$email="";
	$admin=false;
	if(isset($_POST['uname']) && isset($_POST['email']))
	{
		$name=$_POST['uname'];
		$email=$_POST['email'];
		$query="SELECT `Id`, `Name`, `Email`, `Password` FROM `account`";
	    $values=mysqli_query($conn,$query);
		while ($row=mysqli_fetch_array($values)) 
		{
			if($name=="Admin")
			{ 
				if($email==$row['Email'])
				{
					$admin=true;
					break;
				}
			}
		}
		
	}
	$query="SELECT * FROM `detail`";
    $values=mysqli_query($conn,$query);
	while ($row=mysqli_fetch_array($values)) 
	{
		$c=$row['Name'];
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
						<li><a href="index.php">Home <span class="glyphicon glyphicon-home"></span> </a></li>
						<li onclick="clkgal()"><a> Gallery <span class="glyphicon glyphicon-film"></span> </a></li>
						<li class="active"><a> About <span class="glyphicon glyphicon-user"></span> </a></li>
						<li onclick="clkcont()"><a> Contact <span class="glyphicon glyphicon-phone-alt"></span> </a></li>
					</ul>
					<ul class='nav navbar-nav navbar-right'>
						<?php
							if(($_POST["uname"])!="")
							{
								$name=$_POST['uname'];
								$email=$_POST['email'];
								if ($admin)
									echo "<li><a onclick='editabout()'>Edit About</a></li>";
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
		<?php
			$query="SELECT * FROM `detail`";
			$value=mysqli_query($conn,$query);
			while ($row=mysqli_fetch_array($value)) {
				$about =$row['Info'];
				$nme =$row['Name'];
				$p1="image/".$row['P1'];
				$p2="image/".$row['P2'];
				$p3="image/".$row['P3'];
				break;
			}
		?>
		<style type="text/css">
			.item{
				height: 250px; 
				width: 100%;
			}
		</style>
		
		<div class="container-fluid" id="body">
			<div class="container" id="home">
				<div class="row" style="box-shadow: 0px 0px 25px blue inset; border-radius: 6px; padding: 10px;">
					<div class="col-sm-5 col-xs-12" style="text-align: center; padding: 10px;" >
						<div id="myCarousel" class="carousel slide" data-ride="carousel">
						    	<ol class="carousel-indicators">
							      	<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							      	<li data-target="#myCarousel" data-slide-to="1"></li>
							      	<li data-target="#myCarousel" data-slide-to="2"></li>
						    	</ol>
						    	<div class="carousel-inner" style="box-shadow: 0px 0px 20px red; text-align: center;">
						      		<div class="item active">
						        		<img class="img-rounded" src="<?php echo $p1; ?>" alt="Picture 1" style="width:100%; height:100%;">
						      		</div>

						      		<div class="item">
						        		<img class="img-rounded" src="<?php echo $p2; ?>" alt="Picture 2" style="width:100%; height:100%;">
						      		</div>
						    
						      		<div class="item">
						        		<img class=img-rounded" src="<?php echo $p3; ?>" alt="Picture 3" style="width:100%; height:100%;">
						      		</div>
						    	</div>
							    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
							      <span class="glyphicon glyphicon-chevron-left"></span>
							      <span class="sr-only">Previous</span>
							    </a>
							    <a class="right carousel-control" href="#myCarousel" data-slide="next">
							      <span class="glyphicon glyphicon-chevron-right"></span>
							      <span class="sr-only">Next</span>
							    </a>
						</div>
					</div>
					<div class="col-sm-7 col-xs-12" style="padding: 20px; text-align: justify;">
						<?php echo $about; ?>
					</div>
				</div>	
			</div>
		</div>
		<form action="gallery.php" method="post" id="gf">
			<input type="hidden" name="uname" value="<?php echo $name; ?>">
			<input type="hidden" name="email" value="<?php echo $email; ?>">
		</form>
		<form action="contact.php" method="post" id="cf">
			<input type="hidden" name="uname" value="<?php echo $name; ?>">
			<input type="hidden" name="email" value="<?php echo $email; ?>">
		</form>

		<style type="text/css">
			#editabout{
				z-index: 100; 
				position: fixed;
				top: 0px; 
				left: 0px;  
				background-color: rgba(1,1,1,.7); 
				padding: 50px; 
				height: 100%; 
				overflow: auto; 
				width: 100%;
				display: none;
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

		<div class="container-fluid" id="editabout">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4">
					<form action="editabout.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="uname" value="<?php echo $name; ?>">
						<input type="hidden" name="email" value="<?php echo $email; ?>">
						<div class="form-group">
							<label for="name">Edit About</label>
						</div>
						<div class="form-group">
							<label for="name">Enter Name</label>
							<input type="text" name="name" placeholder="Edit Name" id="name" class="form-control">
						</div>
						<div class="form-group">
							<label for="content">Enter Detail</label>
							<textarea type="text" name="content" placeholder="Edit About" id="about" class="form-control" rows=5 style="resize: none;"></textarea>
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
							<button type="reset" onclick="closeedit()" class="btn btn-danger">Discard</button>
						</div>
						
					</form>
				</div>
			</div>
		</div>


	  	<script src="js/jquery.js"></script>
	  	<script src="js/bootstrap.js"></script>


		<script type="text/javascript">
			function clkgal(){
				document.getElementById("gf").submit();
			}
			
			function clkcont(){
				document.getElementById("cf").submit();
			}
			function closeedit(){
				var a=1;
				document.getElementById("editabout").style.display="none";
				document.getElementById("body").style.overflow="auto";
				while(a<=3)
				{
                	var x='photothumb'+a;
                	var y='g'+a;
                	var output = document.getElementById(x);
                	output.src = "background/add.png";
                	document.getElementById(y).value="";
                	a++;
				}
			}

			function cphoto(a){
				var b= "g"+a;
				document.getElementById(b).click();
			}
			function editabout(){
				document.getElementById("editabout").style.display="block";
				document.getElementById("about").value="<?php echo $about; ?>";
				document.getElementById("name").value="<?php echo $nme; ?>";
			}
            var loadFile = function(event,a) {
                var x='photothumb'+a;
                var output = document.getElementById(x);
                output.src = URL.createObjectURL(event.target.files[0]);
            };
		</script>

	</body>

</html>