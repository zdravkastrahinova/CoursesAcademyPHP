<?php
	require '/includes/header.php';
	require '/filters/access_filter.php';
	require '/repositories/comments_repository.php';

	$commentsRepo = new CommentsRepository();
	$courseId = $commentsRepo->getById($_GET["id"])->getCourseId();
	$commentsRepo->delete($_GET['id']);

header("Location: comments.php?course_id=" . $courseId);