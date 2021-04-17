<?php




$login=false;

include("confi.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //       // username and password sent from form 
     
    $username = $_POST['userid'];
    $pass = $_POST['password'];



    $sql = "SELECT * FROM users where user_name='$username'";
    $retval = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($retval);
    if ($num == 1) {
        $row=mysqli_fetch_assoc($retval);
            if(password_verify($pass,$row['user_pass'])){
                $login=true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['userid'] = $username;
                $_SESSION['sno'] = $row['user_id'];
               //$user_id = $row['user_id'];
               
               // header("location:index.php");
            }
            header("location:index.php");
        }
        header("location:index.php");
}
?>