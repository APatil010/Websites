<?php
    $db = new mysqli("localhost:3306", "root", "root", "user_details");
    if ($db) {
    }
    else {
        echo "Error Connecting to The Database.";
    }
?>
