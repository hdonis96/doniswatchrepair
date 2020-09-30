<?php

session_start();

if( isset( $_SESSION['username'] ) ) {
      $validity = checkCredentials();
      if($validity == 0) {
          echo "wrong credentials";
          $_SESSION = [];
          header('Location: http://doniswatchrepair.com/login.html');
      }
      else {
        $user = $_SESSION['username'];
        $name = $_SESSION['f_name'];
        $l_name = $_SESSION['l_name'];
        $email = $_SESSION['email'];
        echo '<p></p>';
        echo "<h1> Hi {$name}! </h1> Here you can find your account information and current or prior services.";
        echo "<p style='color:grey; font-size: small' id='p1'>Username</p>";
        echo "<p style='margin-bottom: 30px'>{$user}</p>";
        echo "<p style='color:grey; font-size: small'>First and Last Name</p>";
        echo "<p style='margin-bottom: 30px'>{$name} {$l_name} </p>";
        echo "<p style='color:grey; font-size: small'>Email</p>";
        echo "<p style='margin-bottom: 50px'>{$email} </p>";
        echo "<p>Services Ordered</p>";
        echo "<table>
                <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Status</th>
                <th>Price</th>
                <th>Details</th>
                </tr>
                <tr>
                <td>08-05-20</td>
                <td>Overhall- Rolex</td>
                <td>Processing</td>
                <td>$100</td>
                <td>not paid</td>
                </tr>
                <td>08-01-20</td>
                <td>Overhall - Seiko</td>
                <td>Complete</td>
                <td>$100</td>
                <td>paid</td>
                </tr>
               </table>";
        
      }
} else {
    echo "wrong credentials";
    $_SESSION = [];
    header('Location: http://doniswatchrepair.com/login.html');
}

function checkCredentials() {
    $myfile = fopen("../js/configs.txt", "r") or die("Unable to open file!!");
    $cookieUsername =  $_SESSION['username'];
    $cookiePassword =  $_SESSION['password'];
    
    $host = 'localhost';
    $dbausername = rtrim(fgets($myfile));
    $dbaPassword = rtrim(fgets($myfile));
    $usertable= rtrim(fgets($myfile));
    $dbaname = rtrim(fgets($myfile));
   
    $connect = mysqli_connect($host,$dbausername, $dbaPassword) or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
    mysqli_select_db($connect, $dbaname);
    
    $query = "SELECT * FROM $usertable WHERE username = '$cookieUsername'";
    $result = mysqli_query($connect, $query);
    
    $valid = 0;
    if ($result) {
    // found username:
        while($row = mysqli_fetch_array($result)) {
            //check password:
            if(strcmp($row['password'], $cookiePassword) !=0) {
                fclose($myfile);
                return 0;
            }
            else { 
                fclose($myfile);
                return 1; //match
            }
        }
    }

    if(valid == 0) {
        return 0;
    }
    fclose($myfile);
} 

?>