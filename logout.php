<?php

session_start();
session_destroy();
$_SESSION = [];
header('Location: http://doniswatchrepair.com/home.html');

?>