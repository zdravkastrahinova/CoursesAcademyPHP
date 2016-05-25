<?php
    require '/includes/header.php';
    require '/filters/access_filter.php';
    require '/repositories/users_repository.php';
    require '/repositories/users_courses_repository.php';

    $usersRepo = new UsersRepository();
    $user = $usersRepo->getById($_GET['id']);

    if($user== null) {
        header("Location: users.php");
    }

    if($user->getIsAdmin() == true) {
        header("Location: userErrorMessage.php");
    }
    else {
        $usersCoursesRepo = new UsersCoursesRepository();
        $usersCoursesRepo->deleteAssignedCoursesByUserId($user->getId());

        $usersRepo->delete($user->getId());
        header('Location: users.php');
    }