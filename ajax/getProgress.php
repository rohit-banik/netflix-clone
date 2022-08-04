<?php

require_once("../includes/config.php");

if(isset($_POST["videoId"]) && isset($_POST["username"])) {
    $query = $conn->prepare("SELECT progress FROM videoprogress
                                WHERE username=:username AND videoId=:videoId");
    $query->bindValue(':username', $_POST["username"]);
    $query->bindValue(':videoId', $_POST["videoId"]);

    $query->execute();
    
    echo $query->fetchColumn();

}
else {
    echo "No Video id or username passed into file";
}

?>