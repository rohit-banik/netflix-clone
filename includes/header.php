<?php

require_once('includes/config.php');
require_once('includes/classes/PreviewProvider.php');
require_once('includes/classes/CategoryContainers.php');
require_once('includes/classes/Entity.php');
require_once('includes/classes/EntityProvider.php');
require_once('includes/classes/ErrorMessage.php');
require_once('includes/classes/SeasonProvider.php');
require_once('includes/classes/Season.php');
require_once('includes/classes/Video.php');
require_once('includes/classes/VideoProvider.php');
require_once('includes/classes/User.php');



if(!isset($_SESSION['userLoggedIn'])) {
    header("Location: login.php");
}

$userLoggedIn = $_SESSION['userLoggedIn'];

?>

<!DOCTYPE html>
<html>

<head>
    <title>Welcome to PremierX</title>

    <link rel="stylesheet" href="./assets/style/style.css">
    <link rel="stylesheet" href="./assets/style/nav.css">
    <link rel="stylesheet" href="./assets/style/search.css">
    <link rel="stylesheet" href="./assets/style/fontawesome/css/all.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="./assets/js/script.js"></script>

</head>

<body>

    <div class="wrapper">


<?php

if(!isset($hideNav)) {
    include_once("includes/navBar.php");
}

?>