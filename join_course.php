<?php
    require '/includes/header.php';
    require '/filters/filter.php';
    require '/repositories/users_courses_repository.php';

    $usersCoursesRepo = new UsersCoursesRepository();
    $usersCoursesRepo->insert(intval($_SESSION["loggedUserId"]), $_GET["id"]);

    header("Location: user_courses.php");
