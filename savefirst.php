<?php
    include ("conn.php");
    $name=$_POST['name'];
    $email=$_POST['email'];
    $detail=$_POST['detail'];
    $pass=$_POST['pass'];

    $path = "image/";

    $pathfull = $path . basename($_FILES["g1"]["name"]);
    move_uploaded_file($_FILES['g1']['tmp_name'], $pathfull);
    $pa1 = basename($_FILES["g1"]["name"]);

    $pathfull = $path . basename($_FILES["g2"]["name"]);    
    move_uploaded_file($_FILES['g2']['tmp_name'], $pathfull);
    $pa2 = basename($_FILES["g2"]["name"]);
    
    $pathfull = $path . basename($_FILES["g3"]["name"]);
    move_uploaded_file($_FILES['g3']['tmp_name'], $pathfull);
    $pa3 = basename($_FILES["g3"]["name"]);


    $query="INSERT INTO `detail`(`Name`, `Info`, `P1`, `P2`, `P3`) VALUES ('$name','$detail','$pa1','$pa2','$pa3')";
    mysqli_query($conn,$query);


    $query="INSERT INTO `account`(`Name`, `Password`, `Email`) VALUES ('Admin','$pass', '$email')";
    mysqli_query($conn,$query);

    mysqli_close($conn);
?>
<html>
    <body>
        <form action="index.php" id="g" method="post">
            <input type="hidden" name="uname" value='<?php echo "Admin"; ?>'>
            <input type="hidden" name="email" value="<?php echo $email ?>">
        </form>
        <script type="text/javascript">
            document.getElementById("g").submit();
        </script>
    </body>
</html>