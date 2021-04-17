<?php
include("confi.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //       // username and password sent from form 

    $username = $_POST['userid'];
    $password = $_POST['password'];
    $cnfpassword = $_POST['cnfpassword'];
    $exitsSql = "select * from users where user_name='$username'";
    $query = mysqli_query($conn, $exitsSql);
    $numRow = mysqli_num_rows($query);
    if ($numRow > 0) {
        $showError = "User name has been already Exist !";
        echo $showError;
    } else {
        if ($password == $cnfpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users`(`user_name`, `user_pass`) VALUES ('$username','$hash')";
            $retval = mysqli_query($conn, $sql);
            if ($retval) {
                echo '<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>you are registered Successfully ! Now you can Login.
              </div>';
                header("location:index.php?signupsuccess=true");
            } else {
                echo "OOps,Something went wrong ! !";
            }
        }
         else {
            echo "Password do not match !";
        }
       // header("location:index.php?signupsuccess=false");
    }    
}
?>