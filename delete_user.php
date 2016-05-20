<?php
    require '/includes/header.php';
    require '/filters/access_filter.php';
    require '/repositories/users_repository.php';

    $usersRepo = new UsersRepository();
    $usersRepo->delete($_GET['id']);

    header('Location: users.php');