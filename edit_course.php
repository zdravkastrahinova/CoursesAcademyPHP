<?php
	require '/includes/header.php';
	require '/includes/sidebar.php';
	require '/filters/access_filter.php';
?>

<?php
	require '/repositories/courses_repository.php';
	$coursesRepo = new CoursesRepository();
	$course = $coursesRepo->getById($_GET["id"]);

	if ($course == null) {
		header("Location: courses.php");
		exit();
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') :

		$course->setTitle(htmlspecialchars(trim($_POST["title"])));
		$course->setContent(htmlspecialchars(trim($_POST["content"])));

		$coursesRepo->update($course);
		header("Location: courses.php");
	else :
?>

	<div class="right">
		<h3>Edit course</h3>
		<div class="form">
			<form method="POST">
				<input type="text" name="title" value="<?= $course->getTitle() ?>" required /> <br>
				<textarea name="content"><?= $course->getContent() ?></textarea> </br>
				<input type="submit" class="submit" value="Edit course" />
			</form>
		</div>
	</div>

	<?php endif; ?>

<?php require '/includes/footer.php'; ?>