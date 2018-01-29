
<?php
	include_once("connect.php");
	if(isset($_COOKIE['blogparasemail']) && isset($_COOKIE['blogparaspass']) && !isset($_POST['uname']) && !isset($_POST['error']))
	{
		echo "<form action='login.php' method='post' id='cookie'>",
				"<input name='email' type='hidden' value='".$_COOKIE['blogparasemail']."'>",
				"<input name='pwd' type='hidden' value='".$_COOKIE['blogparaspass']."'>",
			 "</form>";
		echo "<script> document.getElementById('cookie').submit(); </script>";
				
	}
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

#background{
	box-shadow: 0px 0px 20px darkblue inset;
	border-radius: 6px;
	margin-top: 15px;
	margin-bottom: 25px;
	padding: 8px;
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
	<body id="body">

		<div class="head container-fluid">
			<div class="text">
				Welcome to  My personal blog
			</div>
		</div>

		<div class="container-fluid" id="navbar">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					<a data-toggle="tooltip" title="My facebook"><div class="headtext col-xs-5" > 
						<?php echo $c; ?>
						</div></a>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
					  	<span class="glyphicon glyphicon-list"></span>
					</button>
				</div>	
				<div class="collapse navbar-collapse" id="menu">
					<ul class="nav navbar-nav">
						<li class="active" title="Home Page(Actived)"><a href="index.php">Home <span class="glyphicon glyphicon-home"></span> </a></li>
						<li onclick="clkgal()" title="Gallery Page"><a> Gallery <span class="glyphicon glyphicon-film"></span> </a></li>
						<li onclick="clkabt()" title="About Page"><a> About <span class="glyphicon glyphicon-user"></span> </a></li>
						<li onclick="clkcont()" title="Contact Page"><a> Contact <span class="glyphicon glyphicon-phone-alt"></span> </a></li>
						<li title="Downloads Menu"><a href="#" data-toggle="dropdown"> Downloads <span>▼</span></a>
							<ul class="dropdown-menu" style="padding: 7px;text-align: center; border: 1px solid lightblue; border-radius: 6px;">
								<li><a onclick="downloads('Software')" title="Softwares Page">Softwares</a></li>
								<li><a onclick="downloads('MobileApps')" title="Mobile Apps Page">Mobile Apps</a></li>
								<li><a onclick="downloads('Antivirus')" title="Antivirus  Page">Antivirus</a></li>
							</ul>
						</li>
					</ul>
					<?php
						if(isset($_POST["logedin"]))
						{
							$name=$_POST['uname'];
							$email=$_POST['email'];
							echo "<ul class='nav navbar-nav navbar-right'>";
							if($admin){
								echo "<li><a onclick='displayblogform()'>Add Blog</a></li>";
							}
							echo "<li><a onclick='signout()'>".$name."(Log Out)</a></li>";
							echo "</ul>";
						}
						else
						{
							echo "<ul class='nav navbar-nav navbar-right'>",
									"<li><a onclick='login()'>Log In</a></li>",
									"<li><a onclick='signin()'>Sign Up</a></li>",
								"</ul>";
						}
					?>
				</div>	
				<div class="progress-container">
			   		<div class="progress-bar" id="myBar"></div>
				</div>  
			</nav>
		</div>


		<div class="container" style="padding-left: 80px; padding-right: 80px;">
			<?php
				$query="SELECT * FROM `blog` ORDER BY Sn DESC";
			    $values=mysqli_query($conn,$query);
			    echo "<h2 style='text-align: center; color:red;'><u><b>My Blogs</b></u></h2>";
			    $sn=0;
				while ($row=mysqli_fetch_array($values)) {
					$sn++;
						echo '<div class="container-fluid" id="background">';
							echo '<div class="container-fluid">';
								echo "<div class='row'  style='padding: 5px;'>";
									echo '<div class="col-sm-6 col-xs-12" style="padding-left: 20px; text-align: justify; color: black; margin-bottom:20px;">';
										if($admin)
										{
											echo "<div class='row' style='text-align: center;'>";
												echo "<a onclick='delblog($row[Sn])' style='cursor:pointer; color: darkred;'><b>Delete</b></a>";
											echo "</div>";
										}
										echo "<div class='row'>";
											echo "<h3 style='text-align: center;color: darkblue;'><b>$row[title]</b></h3>";
										echo "</div>";
										echo "<div class='row'><span style='margin: 30px; color:black; text-align:justify;'>";
											echo $row['blog'];
										echo "</span></div>";
									echo '</div>';

									echo '<div class="col-sm-5 col-sm-offset-1 col-xs-12" style="text-align: center; padding-right: 20px;" >';

										echo '<div id="myCarousel'.$sn.'" class="carousel slide" data-ride="carousel">',
								    			'<ol class="carousel-indicators">';
								    			if(!empty($row['p1']))
									      			echo '<li data-target="#myCarousel'.$sn.'" data-slide-to="0" class="active"></li>';
								    			if(!empty($row['p2']))
									      			echo '<li data-target="#myCarousel'.$sn.'" data-slide-to="1"></li>';
								    			if(!empty($row['p3']))
									      			echo '<li data-target="#myCarousel'.$sn.'" data-slide-to="2"></li>';
									    	echo '</ol>';
										    echo '<div class="carousel-inner" style="text-align:center;">';
									    		if(!empty($row['p1']))
									    		{
									    			echo '<div class="item active">';
									    				echo '<a href="blog/'.$row["title"].'/'.$row["p1"].'"><img class="img-thumbnail img-rounded" style="height: 250px; width: 100%; text-align:center;" src="blog/'.$row["title"].'/'.$row["p1"].'" alt="picture1"></a>';
									    			echo "</div>";
									    		}
									    		if(!empty($row['p2']))
									    		{
									    			echo '<div class="item">';
									    				echo '<a href="blog/'.$row["title"].'/'.$row["p2"].'"><img class="img-thumbnail img-rounded" style="height: 250px; width: 100%; text-align:center;" src="blog/'.$row["title"].'/'.$row["p2"].'" alt="picture2"></a>';
									    			echo "</div>";
									    		}
									    		if(!empty($row['p3']))
									    		{
									    			echo '<div class="item">';
									    				echo '<a href="blog/'.$row["title"].'/'.$row["p3"].'"><img class="img-thumbnail img-rounded" style="height: 250px; width: 100%; text-align:center;" src="blog/'.$row["title"].'/'.$row["p3"].'" alt="picture3"></a>';
									    			echo "</div>";
									    		}
									    	echo '</div>';
											echo '<a class="left carousel-control" href="#myCarousel'.$sn.'" data-slide="prev">',
										      		'<span class="glyphicon glyphicon-chevron-left"></span>',
										      		'<span class="sr-only">Previous</span>';
										    	'</a>';
										    echo '<a class="right carousel-control" href="#myCarousel'.$sn.'" data-slide="next">',
										      		'<span class="glyphicon glyphicon-chevron-right"></span>',
										      		'<span class="sr-only">Next</span>',
										    	'</a>';
										echo '</div>';
									echo "</div>";
								echo "</div>";

							echo '</div>';
						echo "</div>";
				}
				if($sn==0)
				{
					echo '<div class="container-fluid" id="background" style="text-align:center;">';
						echo "<h4 style='color:red;text-align:center;'>No Blogs Found</h4>";
					echo "</div>";
				}
			

			?>
		</div>

		<style type="text/css">
			.login{
				background-color: rgba(0,0,0,.5);
				position: fixed;
				top: 0;
				z-index: 100;
				height: 100%;
				width:100%;
				padding-top:100px;
			}
			.form{
				background-color: darkred;
				padding: 12px;
				margin-left: auto;
				margin-right:auto; 
				width:300px;
				color: white;
				border-radius: 8px;
				text-align: center;
				display: none;
			}
			#form{
				display: none;
			}
			.imgbox{
				cursor: pointer; 
				height: 100px; 
				width: 100px; 
				margin: 3px;
			}
		</style>

		<div class="container-fluid login" id="form" >
			<div class="form" id="login">
				<form action="login.php" method="post">
					<div class="form-group">
						<label for="title">Log In</label>
						<?php
							if (isset($_GET['error'])) {
								if($_GET['error']==400)
								{
									echo "<br/><label for='error'>Wrong UserName or Password</label>";
									echo "<script> document.getElementById('form').style.display='block';",
										" document.getElementById('login').style.display='block'; </script>";
								}
							}
						?>
					</div>
					<div class="form-group">
					    <label for="email">Email:</label>
					    <input type="email" class="form-control" id="name" name="email">
					</div>
					<div class="form-group">
					    <label for="pwd">Password:</label>
					    <input type="password" class="form-control" id="pwd" name="pwd">
					</div>
					<div class="checkbox">
					    <label><input type="checkbox" name="check" value="checked"> Remember me</label>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="button" onclick="fclose()" class="btn btn-danger">Close</button>
				</form>
			</div>

			<div class="form" id="signup">
				<form action="signup.php" method="post">
					<div class="form-group">
						<label for="title">Sign Up</label>
					</div>
					<div class="form-group">
					    <label for="name">Name</label>
					    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
					</div>
					<div class="form-group">
					    <label for="email">Email address:</label>
					    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
					</div>
					<div class="form-group">
					    <label for="pwd">Password:</label>
					    <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter Password" onKeyUp="passcheck()" required>
					</div>
					<div class="form-group">
					    <label for="pwd">Conform Password:</label>
					    <input type="password" class="form-control" id="pwdconf" placeholder="Re-Enter Password" onKeyUp="passcheck()" required>
					</div>
					<div class="form-group">
						<div for="passwordconform" id="pas"></div>
					</div>
					<div class="checkbox">
					    <label><input type="checkbox" value="check"> Remember me </label>
					    <label><input type="checkbox" id="passvis" onclick="passvisible()"> Show Password </label>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="button" onclick="fclose()" class="btn btn-danger">Close</button>
				</form>
			</div>
		</div>
		
		<div>
			<form action="download.php" method="post" id="df">
				<input type="hidden" name="uname" value="<?php echo $name; ?>">
				<input type="hidden" name="email" value="<?php echo $email; ?>">
				<input type="hidden" name="dtype" id="dtype">
			</form>
			<form action="gallery.php" method="post" id="gf">
				<input type="hidden" name="uname" value="<?php echo $name; ?>">
				<input type="hidden" name="email" value="<?php echo $email; ?>">
			</form>
			<form action="about.php" method="post" id="af">
				<input type="hidden" name="uname" value="<?php echo $name; ?>">
				<input type="hidden" name="email" value="<?php echo $email; ?>">
			</form>
			<form action="contact.php" method="post" id="cf">
				<input type="hidden" name="uname" value="<?php echo $name; ?>">
				<input type="hidden" name="email" value="<?php echo $email; ?>">
			</form>


			<form action="delblog.php" method="post" id="delblog">
				<input type="hidden" name="uname" value="<?php echo $name; ?>">
				<input type="hidden" name="email" value="<?php echo $email; ?>">
				<input type="hidden" name="Sn" value="" id='delblogf'>
			</form>
		</div>



		<style type="text/css">
			#addblog{
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
		</style>

		<div class="container-fluid" id="addblog">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4">
					<form action="addblog.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="uname" value="<?php echo $name; ?>">
						<input type="hidden" name="email" value="<?php echo $email; ?>">
						<div class="form-group">
							<label for="name">Add New Blog</label>
						</div>
						<div class="form-group">
							<label for="title">Enter Title</label>
							<input type="text" name="title" class="form-control" placeholder="Entre Title">
						</div>
						<div class="form-group">
							<label for="content">Enter Content</label>
							<textarea type="text" name="content" placeholder="Blog" class="form-control" rows=5 style="resize: none;"></textarea>
						</div>
						<div class="form-group">
							<label for="images">Select Images</label>
							<div style="display: none;">
							    <input type="file" id="g1" name="g1" accept="image/*" size="25" onchange='loadFile(event,1)'>
							    <input type="file" id="g2" name="g2" accept="image/*" size="25" onchange='loadFile(event,2)'>
							    <input type="file" id="g3" name="g3" accept="image/*" size="25" onchange='loadFile(event,3)'>
							</div>
							<div class="row">
							    <img onclick='cphoto(1)' src="background/add.png" id="photothumb1" class="img-rounded imgbox">
						    	<img onclick="cphoto(2)" src="background/add.png" id="photothumb2" class="img-rounded imgbox">
						    	<img onclick="cphoto(3)" src="background/add.png" id="photothumb3" class="img-rounded imgbox">
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-success">Save</button>
							<button type="reset" onclick="clearall()" class="btn btn-danger">Discard</button>
						</div>
						
					</form>
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

			function fclose(){
				document.getElementById("form").style.display="none";
				document.getElementById("login").style.display="none";
				document.getElementById("signup").style.display="none";
			}

			function delblog(a)
			{
				document.getElementById("delblogf").value=a;
				document.getElementById("delblog").submit();
			}

			function login()
			{
				document.getElementById("form").style.display="block";
				document.getElementById("login").style.display="block";
			}
			function signin()
			{
				document.getElementById("form").style.display="block";
				document.getElementById("signup").style.display="block";
			} 


    		function passcheck()
    		{
				var password = $("#pwd").value();
    			var confirmPassword = $("#pwdconf").value();
    			if(password=="")
    			{
        			$("#pas").html("");
    			}
    			else
				{
				    if (password != confirmPassword)
    				{
        				$("#pas").html("Passwords do not match!");
    				}
    				else
    				{
        				$("#pas").html("Passwords match!");
    				}
    			}
    		}

    		function passvisible(){
			    var tag = getElementById("pwd");
			    var tag2 = getElementById("passvis");
			    if (tag2.checked = true){
			        tag.type="text";   
			    }
			    else{
			        tag.type="password";   
			    }

			}
		</script>

		<script type="text/javascript">
			function signout(){
				window.location.replace("signout.php");
			}

			function downloads(a){
				document.getElementById("dtype").value=a;
				document.getElementById("df").submit();
			}
		</script>

		<script type="text/javascript">
			function clkgal(){
				document.getElementById("gf").submit();
			}
			function clkabt(){
				document.getElementById("af").submit();
			}
			
			function clkcont(){
				document.getElementById("cf").submit();
			}
			function displayblogform(){
				document.getElementById("addblog").style.display="block";
				document.getElementById("body").style.overflow="hidden";
			}
			function cphoto(a){
				var b= "g"+a;
				document.getElementById(b).click();
			}
			function clearall(){
				var a=1;
				document.getElementById("addblog").style.display="none";
				document.getElementById("body").style.overflow="auto";
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

	</body>

</html>