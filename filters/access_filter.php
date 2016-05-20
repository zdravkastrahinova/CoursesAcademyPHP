<?php
    if (isset($_SESSION["loggedUserId"])) {
        if ($_SESSION["loggedUserIsAdmin"] == false) {
            header("Location: error.php");
            exit();
        }
    } else {
        header("Location: error.php");
        exit();
    }