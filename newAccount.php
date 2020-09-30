<?php
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

if(empty($f_name) && empty($l_name) && empty($username) && empty($password) && empty($email)) {
    header('Location: http://doniswatchrepair.com/home.html');
    die();
}
elseif(empty($f_name) || empty($l_name) || empty($username) || empty($password) || empty($email)) {
    die ("<html><script language='JavaScript'>alert('Please fill in all fields'),history.go(-1)</script></html>");
}

$host = 'localhost';
$dbausername = '';
$dbaPassword = "";
$dbaname = "";

$usertable="Accounts";
$yourfield = "email";

$connect = mysqli_connect($host,$dbausername, $dbaPassword) or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
mysqli_select_db($connect, $dbaname);
	
	
// check for duplicates

$query = "SELECT * FROM $usertable WHERE email = '$email'";
$result = mysqli_query($connect, $query);
echo $query;
if ($result) {
    while($row = mysqli_fetch_array($result)) {
        die ("<html><script language='JavaScript'>alert('This email is already associated with an account'),history.go(-1)</script></html>");
    }
}
$query = "SELECT * FROM $usertable WHERE username = '$username'";
$result = mysqli_query($connect, $query);
echo $query;
if ($result) {
    while($row = mysqli_fetch_array($result)) {
        die ("<html><script language='JavaScript'>alert('This username is already taken'),history.go(-1)</script></html>");
    }
}

	
/*	echo "Name: ".$name."<br/>";
}*/

$queryInsert = "INSERT INTO Accounts (username, password, f_name, l_name, email) VALUES ('$username', '$password', '$f_name', '$l_name', '$email')";
	
$insertResult = mysqli_query($connect, $queryInsert);
	
if($insertResult){
	echo "Successfully created account with email: " . $email;
	echo '<script type="text/javascript">alert("Success! You can now login to your new account.");document.location = "login.html";</script>';
	endQuery();
} else {
    echo "Error creating account: " . mysqli_error($connect);
    endQuery();
}
	 
function endQuery() {
    mysqli_free_result($result);
    mysqli_close($connect);
  //  header('Location: http://doniswatchrepair.com/login.html');
}	

?>