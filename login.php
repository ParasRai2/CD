<?php
    include ("connect.php");

    if (isset($_POST['email']) && isset($_POST['pwd'])) {
        $name=$_POST['email'];
        $pass=$_POST['pwd'];
        $query="SELECT `Name`, `Email`, `Password` FROM `account`";
        $values=mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($values)) {
            if($row['Email']==$name && $row['Password']==$pass)
            {        
                mysqli_close($conn);
                if(!empty($_POST['check']))
                {                   
                    setcookie("blogparasemail", $name, time() + (86400 * 30), "/");
                    setcookie("blogparaspass", $pass, time() + (86400 * 30), "/");
                }
                echo "<form  id='f' action='index.php' method='post'>",
                    "<input type='hidden' name='logedin' value='1'/>",
                    "<input type='hidden' name='uname' value='$row[Name]'/>",
                    "<input type='hidden' name='email' value='$row[Email]'/>",
                    "<form>";
                echo "<script> document.getElementById('f').submit(); </script>";
                exit();
            }
        }
        mysqli_close($conn);
        header('Location: index.php?error=400');
        exit();
    } 
    else {
        
    }
?>