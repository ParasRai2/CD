
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
		while ($row=mysqli_fetch_array($values)) {
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
		$c =$row['Name'];
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
						<li onclick="clkgal()" title="Gallery Page"><a> Gallery <span class="glyphicon glyphicon-film"></span> </a></li>
						<li onclick="clkabt()" title="About Page"><a> About <span class="glyphicon glyphicon-user"></span> </a></li>
						<li class="active" title="Contact Page(Activated)"><a> Contact <span class="glyphicon glyphicon-phone-alt"></span> </a></li>
					</ul>
					<ul class='nav navbar-nav navbar-right'>
						<?php
							if(($_POST["uname"])!="")
							{
								$name=$_POST['uname'];
								$email=$_POST['email'];
								if($admin)
									echo "<li><a onclick='conf()'>Add Contact</a></li>";
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


		<div class="container" style="box-shadow: 0px 0px 25px darkred inset; border-radius: 8px; padding: 20px; text-align: center;">
			<table class="table table-condensed table-hover">
			    <thead>
				    <tr>
				        <th style="text-align: center;">Contact Type</th>
				        <th style="text-align: center;">Contact</th>
				        <?php
				        	if($admin)
				        	{
				        		echo "<th style='text-align: center;'> Option </th>";
				        	}
				        ?>
				    </tr>
				    <?php
					$sn=1;
			        $query="SELECT * FROM `contacts`";
			        $values=mysqli_query($conn,$query);
			        while ($row=mysqli_fetch_array($values)) {   
		            	echo "<tbody>",
		            		"<tr>",
		            			"<td>".$row['type']."</td>";
		            		if($row['type']=="Website" || $row['type']=="Facebook" || $row['type']=="Twitter" || $row['type']=="LinkedIN" || $row['type']=="Instagram")
		            			echo "<td title=$row[type]><a href='$row[contacts]' style='color:black; text-decoration:none;'>".$row['contacts']."</a></td>";
		            		else
		            			echo "<td title=$row[type] style='cursor: pointer;'>".$row['contacts']."</td>";


			        	if($admin)
			        	{
			        		echo "<th style='text-align:center;'>";
			        			echo "<a class='text-danger' style='cursor:pointer; margin-left:5px;' title='Click to Delete' onclick='delcontact($row[Sn]);'>Delete</a></div>";
			        		echo "</th>";
			        	}
			        	echo "</tr></tbody>";
			        	$sn++;
			        }
			        mysqli_close($conn);
				?>
			</table>
				<?php
					if($sn==1)
						echo "<div class='container-fluid text-danger' style='text-align: center;'>No Contacts Available</div>";
				?>
		</div>



		<form action="about.php" method="post" id="af">
			<input type="hidden" name="uname" value="<?php echo $name; ?>">
			<input type="hidden" name="email" value="<?php echo $email; ?>">
		</form>
		<form action="gallery.php" method="post" id="gf">
			<input type="hidden" name="uname" value="<?php echo $name; ?>">
			<input type="hidden" name="email" value="<?php echo $email; ?>">
		</form>

		<form action="delcontact.php" method="post" id='del'>
			<input type="hidden" name="uname" value="<?php echo $name; ?>">
			<input type="hidden" name="email" value="<?php echo $email; ?>">
			<input type="hidden" name="sn" id='sn'>
		</form>


		<div class="container-fluid" style="position: fixed; top:0; left: 0; display: none; background-color: rgba(1,1,1,.8); width:100%; height: 100%; " id="confield">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4" style="padding:50px;">
					<div class="form" style="border-radius: 8px; background-color: white; padding: 10px; text-align: center;">
						<form action="addcontact.php" method="post">
							<div class="form-group">
								<label for="title">Add Contact</label>
							</div>
							<div class="form-group">
								<label for="type">Select Type</label>
								<select class="form-control" onchange="changetype()" id="type" name="type" required>
									<option>Phone No</option>
									<option>Phone No(Office)</option>
									<option>E-mail</option>
									<option>Website</option>
									<option>Facebook</option>
									<option>Twitter</option>
									<option>LinkedIN</option>
									<option>Instagram</option>
								</select>
							</div>
							<div class="form-group">
								<style type="text/css">
									input[type=number]::-webkit-inner-spin-button, 
									input[type=number]::-webkit-outer-spin-button { 
									    -webkit-appearance: none;
									    -moz-appearance: none;
									    appearance: none;
									    margin: 0; 
									}
								</style>
								<label for="title">Enter Contact</label>
								<input type="number" class="form-control" name="contact" id="con" required>
								<script type="text/javascript">
									function changetype(){
										var con=document.getElementById("con");
										var typee=document.getElementById("type");
										if(typee.value=="E-mail")
											con.type="email";
										else if(typee.value=="Website" || typee.value=="Facebook" || typee.value=="Twitter" || typee.value=="LinkedIN" || typee.value=="Instagram")
											con.type="url";
										else if(typee.value=="Phone No" || typee.value=="Phone No(Office)")
											con.type="number";
									}
								</script>
							</div>
							<div class="form-group">
								<input type="hidden" name="uname" value="<?php echo $name ?>">
								<input type="hidden" name="email" value="<?php echo $email ?>">
								<button type="submit" class="btn btn-primary">Save</button>
								<button type="reset" onclick="closee()" class="btn btn-danger">Discard</button>
							</div>
						</form>
					</div>
				</div>
				
			</div>
		</div>

	  	<script src="js/jquery.js"></script>
	  	<script src="js/bootstrap.js"></script>

	  	<script type="text/javascript">
	  		function delcontact(a){
	  			document.getElementById('sn').value=a;
	  			document.getElementById('del').submit();
	  		}
	  	</script>


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

			function clkgal(){
				document.getElementById("gf").submit();
			}
			function clkabt(){
				document.getElementById("af").submit();
			}
			function closee(){
				document.getElementById("confield").style.display="none";
			}
			function conf(){
				document.getElementById("confield").style.display="block";
			}
		</script>

	</body>

</html>