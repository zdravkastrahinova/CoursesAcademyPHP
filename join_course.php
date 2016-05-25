<?php
    require '/includes/header.php';
    require '/filters/filter.php';
    require '/models/course.php';
    require '/repositories/users_courses_repository.php';

    $usersCoursesRepo = new UsersCoursesRepository();

    if($usersCoursesRepo->checkIfCourseIsAssigned(intval($_SESSION["loggedUserId"]), $_GET["id"]) == true) {
        header("Location: errorAlreadyAssignedCourse.php");
    }
    else {
        $usersCoursesRepo->insert(intval($_SESSION["loggedUserId"]), $_GET["id"]);
        header("Location: user_courses.php");
    }