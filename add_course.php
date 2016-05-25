<?php
	require '/includes/header.php';
	require '/includes/sidebar.php';
	require '/filters/access_filter.php';
	require '/repositories/courses_repository.php';

	$errorMsg = "";

	if ($_SERVER['REQUEST_METHOD'] === 'POST') :
		$title = htmlspecialchars(trim($_POST["title"]));
		$content = htmlspecialchars(trim($_POST["content"]));

		if (empty($title) || empty($content)) {
			$errorMsg = "All fields are required.";
			header("Location: add_course.php?errorMsg=$errorMsg");
		}

		$coursesRepo = new CoursesRepository();

		$course = new Course();
		$course->setTitle($title);
		$course->setContent($content);

		$coursesRepo->insert($course);

		header("Location: courses.php");
	else :
?>

		<div class="right" xmlns="http://www.w3.org/1999/html">
			<h3>Add new course</h3>
			<div class="form">
				<form method="POST">
					<p class="error">
						<?php
							if (isset($_GET["errorMsg"])) {
								echo $_GET["errorMsg"];
							}
						?>
					</p>

					<input type="text" name="title" placeholder="Enter title..." required /> <br>
					<textarea name="content" placeholder="Enter content..." required></textarea> </br>
					<input type="submit" class="submit" value="Add course" />
				</form>
			</div>
		</div>

<?php
	endif;
	require '/includes/footer.php';
?>