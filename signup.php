<?php
    include ("connect.php");

    if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['email'])) {
        $name=$_POST['name'];
        $pass=$_POST['password'];
        $email=$_POST['email'];
        $query="INSERT INTO `account`(`Name`, `Password`, `Email`) VALUES ( '$name', '$pass', '$email')";
        mysqli_query( $conn, $query);
        mysqli_close($conn);
        $subject = 'You are heartly welcome to my blog';
        $message = 'Hello '.$name.'!!';
        $headers = 'From: paras.rai38@gmail.com '. "\r\n" .
            'Reply-To: '.$email . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($email, $subject, $message, $headers);

        echo '<form action="login.php" method="post" id="df">',
                '<input type="hidden" name="uname" value="'.$name.'">',
                '<input type="hidden" name="email" value="'.$email.'">',
                '<input type="hidden" name="pwd" value="'.$pass.'">',
                
            '</form>';
        echo "<script> document.getElementById('df').submit(); </script>";
        exit();
    } 
?>