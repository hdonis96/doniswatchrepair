<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Donis Watch Repair</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="accountStyle.css">
    
</head>
<body>
    <ul>
        <li><a class="homeLink" href= "http://doniswatchrepair.com/home.html">&#8592;Home</a></li>
        <li><a class="logoutLink" href= "http://doniswatchrepair.com/logout.php">Logout</a></li>
        <li><a class="accountTitle" hfref="#">&#9881; Account Information</a></li>
         
    </ul>
    <!-- <img src="arrowThickHome.png" id="arrow" onclick="returnHome()"> -->
    <!-- unicode arrow & gears: &#9881; &#9964; -->
    
    <div class="infoDiv">
    <?php include 'account.php';?>
    <p></p>
    </div>

<script>
    function returnHome() {
      window.location.href = "http://doniswatchrepair.com/home.html";
    }
</script>

</body>
</html>