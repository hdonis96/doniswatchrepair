<?php
$username = $_POST['username'];
$password = $_POST['password'];
session_start();

if( isset( $_SESSION['username'] ) ) {
    // if already logged in:
    if(checkCredentials($_SESSION['username'], $_SESSION['password'])) {
      die ("<html><script language='JavaScript'>alert('You are already logged in'),history.go(-1)</script></html>");
    }
}
    
if(empty($username) || empty($password)) {
    die ("<html><script language='JavaScript'>alert('Please fill in all fields'),history.go(-1)</script></html>");
}

if (checkCredentials($username, $password)) {
    $_SESSION["username"]=$username;
    $_SESSION["password"]=$password;
    $_SESSION["l_name"]=$row['l_name'];
    $_SESSION["f_name"]=$row['f_name'];
    $_SESSION["email"]=$row['email']; 
    header('Location: http://doniswatchrepair.com/accountPage.php');
} else {
    die ("<html><script language='JavaScript'>alert('Incorrect username or password'),history.go(-1)</script></html>"); 
}

function checkCredentials($username, $password) {

    $myfile = fopen("../js/configs.txt", "r") or die("Unable to open file!!");
    
    $host = 'localhost';
    $dbausername = rtrim(fgets($myfile));
    $dbaPassword = rtrim(fgets($myfile));
    $usertable= rtrim(fgets($myfile));
    $dbaname = rtrim(fgets($myfile));
    
    $connect = mysqli_connect($host,$dbausername, $dbaPassword) or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
    mysqli_select_db($connect, $dbaname);
    
    $query = "SELECT * FROM $usertable WHERE username = '$username'";
    $result = mysqli_query($connect, $query);
    
    $user_exists = 0;
    
    
    if ($result) {
        // found username:
        while($row = mysqli_fetch_array($result)) {
            $user_exists = 1;
            //check password:
            if(strcmp($row['password'], $password) !=0) {
                mysqli_close($connect);
                return false;
            }
            else { 
                mysqli_close($connect);
                return true;
            }
        }
    }
    
    if(user_exists == 0) {
     mysqli_close($connect);
     return false;
    }
}

?>
