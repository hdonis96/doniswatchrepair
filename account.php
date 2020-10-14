<?php
// Validates login credentials and renders account info
session_start();

if( isset( $_SESSION['username'] ) ) {
      $validity = queryDB('checkCredentials');
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
                </tr>";
        queryDB('populateTable');
        echo "</table>";
      }
} else {
    echo "wrong credentials";
    $_SESSION = [];
    header('Location: http://doniswatchrepair.com/login.html');
}

function queryDB($queryType) {
    $myfile = fopen("../js/configs.txt", "r") or die("Unable to open file!!");
    $cookieUsername =  $_SESSION['username'];
    $cookiePassword =  $_SESSION['password'];
    
    $host = 'localhost';
    $dbausername = rtrim(fgets($myfile));
    $dbaPassword = rtrim(fgets($myfile));
    $usertable= rtrim(fgets($myfile));
    $dbaname = rtrim(fgets($myfile));
     
    if(strcmp($queryType, 'populateTable') == 0) {
      $usertable = 'Services';
    }

    $connect = mysqli_connect($host,$dbausername, $dbaPassword) or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
    mysqli_select_db($connect, $dbaname);
    
    $query = "SELECT * FROM $usertable WHERE username = '$cookieUsername'";
    $result = mysqli_query($connect, $query);
    
    $valid = 0;
    if ($result) {
    // found username:
        while($row = mysqli_fetch_array($result)) {
            //check credentials:
            if(strcmp($queryType, 'checkCredentials') == 0) {
               if(strcmp($row['password'], $cookiePassword) !=0) {
                fclose($myfile); //credentials are incorrect
                return 0;
                }
                else {
                    // credentials are correct
                    fclose($myfile);
                    return 1; //match
                }
            } 
            //else populate table:
            else {
                echo 
                "<tr>
                <td>{$row['Date']}</td>
                <td>{$row['Description']}</td>
                <td>{$row['Status']}</td>
                <td>{$row['Price']}</td>
                <td>{$row['Details']}</td>
                </tr>";
            }
        }
    }

    if(valid == 0) {
        return 0;
    }
    fclose($myfile);
} 

?>
