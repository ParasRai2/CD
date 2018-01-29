
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
			if($name=="Admin" && $email==$row['Email'])
			{
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
					<a href="https://www.facebook.com/profile.php?id=100009890495937" data-toggle="tooltip" title="My facebook"><div class="headtext col-xs-5" > <?php echo $c; ?> </div></a>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
					  	<span class="glyphicon glyphicon-list"></span>
					</button>
				</div>	
				<div class="collapse navbar-collapse" id="menu">
					<ul class="nav navbar-nav">
						<li><a href="index.php">Home <span class="glyphicon glyphicon-home"></span> </a></li>
						<li onclick="clkgal()"><a> Gallery <span class="glyphicon glyphicon-film"></span> </a></li>
						<li onclick="clkabt()"><a> About <span class="glyphicon glyphicon-user"></span> </a></li>
						<li onclick="clkcont()"><a> Contact <span class="glyphicon glyphicon-phone-alt"></span> </a><li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php
							if($_POST["uname"]=="")
							{
								echo "<li><a href='index.php'>Please Log In to Download</a></li>";
							}
							else {
								if($admin){
									echo "<li><a onclick='addfile()'>Add File</a></li>";
								}
								echo "<li><a>".$name."</a></li>";
							}
						?>
					</ul>
				</div>	
				<div class="progress-container">
			   		<div class="progress-bar" id="myBar"></div>
				</div>  
			</nav>
		</div>
<style type="text/css">
	.table td {
   		text-align: center; 
   		color: black;  
	}
	.table th {
   		text-align: center;
   		color: blue;   
	}
</style>
		<div class="container" style="border-radius: 6px; border: 1px  solid lightgrey; padding-top: 20px;">
			<table class="table table-condensed table-hover">
			    <thead>
				    <tr>
				        <th>SN</th>
				        <th><?php echo $_POST['dtype']; ?></th>
				        <th>Details</th>
				        <?php
				        	if($name!="")
				        	{
				        		echo "<th> Option </th>";
				        	}
				        ?>
				    </tr>
			    </thead>
				<?php
					$type=$_POST['dtype'];
					$sn=1;
			        $query="SELECT `Sn`, `Name`, `file`, `Type`, `Detail` FROM `downloads`";
			        $values=mysqli_query($conn,$query);
			        while ($row=mysqli_fetch_array($values)) {
			            if($row['Type']==$type)
			            {      
			            	echo "<tbody>",
			            		"<tr>",
			            			"<td>".$sn."</td>",
			            			"<td>".$row['Name']."</td>",
			            			"<td>".$row['Detail']."</td>";

				        	if($name!="")
				        	{
				        		echo "<th> <div><a href='downloads/".$type."/$row[file]' title='Click to Download' >Download</a> ";
				        		if ($admin==true)
				        		{
				        			echo "<a class='text-danger' style='cursor:pointer; margin-left:5px;' title='Click to Delete' onclick='return delfile($row[Sn]);'>Delete</a></div>";
				        		}
				        		echo "</th>";
				        	}
				        	echo "</tr></tbody>";
				        	$sn++;
			            }
			        }
			        mysqli_close($conn);
				?>
			</table>
				<?php
					if($sn==1)
						echo "<div class='container-fluid text-danger' style='text-align: center;'>No ".$type." Available</div>";
				?>
		</div>

		<form id='df' action="delete.php" method="post">
			<input type="hidden" name="uname" value="<?php echo $name; ?>">
			<input type="hidden" name="email" value="<?php echo $email ?>">
			<input type="hidden" name="type" value="<?php echo $type ?>">
			<input type="hidden" name="Sn" id="delSn">
		</form>
		<form id='addf' action="addfile.php" method="post">
			<input type="hidden" name="uname" value="<?php echo $name; ?>">
			<input type="hidden" name="email" value="<?php echo $email ?>">
			<input type="hidden" name="type" value="<?php echo $type ?>">
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


	  	<script src="js/jquery.js"></script>
	  	<script src="js/bootstrap.js"></script>
	  	<script type="text/javascript">
	  		function delfile(a)
	  		{
	  			document.getElementById("delSn").value=a;
	  			document.getElementById("df").submit();
	  		}
	  		function addfile()
	  		{
	  			document.getElementById("addf").submit();
	  		}

	  		function clkgal(){
				document.getElementById("gf").submit();
			}
			function clkabt(){
				document.getElementById("af").submit();
			}
			
			function clkcont(){
				document.getElementById("cf").submit();
			}
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