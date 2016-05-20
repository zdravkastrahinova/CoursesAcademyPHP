<?php
    if (!isset($_SESSION["loggedUserId"])) {
        header("Location: error.php");
        exit();
    }