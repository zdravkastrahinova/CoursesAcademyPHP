<?php
	require '/includes/header.php';
	require '/filters/access_filter.php';
	require '/repositories/courses_repository.php';
	require '/repositories/comments_repository.php';

	$coursesRepo = new CoursesRepository();
	$course = $coursesRepo->getById($_GET["id"]);

	if ($course == null) {
		header('Location: courses.php');
	}

	$commentsRepo = new CommentsRepository();
	$commentsRepo->deleteAllByCourseId($course->getId());

	$coursesRepo->delete($_GET['id']);

	header('Location: courses.php');