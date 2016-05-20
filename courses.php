<?php
	require '/includes/header.php';
	require '/includes/sidebar.php';
	require '/repositories/courses_repository.php';
	require '/repositories/users_repository.php';
?>

	<div class="right">
		<section id="courses">
			<h2>List Courses</h2>
			<?php
				$loggedUser = null;

				if (isset($_SESSION["loggedUserId"])) {
					$usersRepo = new UsersRepository();
					$loggedUser = $usersRepo->getById($_SESSION["loggedUserId"]);

					if ($loggedUser->getIsAdmin()) {
						echo "<a href=\"add_course.php\"><h3>Add new course</h3></a>";
					}
				}

				$coursesRepo = new CoursesRepository();
				$courses = $coursesRepo->getAll();
				foreach ($courses as $c) :
			?>

				<article class="course-content">
					<h3><?= $c->getTitle() ?></h3>
					<p><?= $c->getContent() ?></p>
					<a href="comments.php?course_id=<?= $c->getId()?>" class="view-comments">View comments</a>
					<?php
						if ($loggedUser !== null) :
					?>
						| <a href="join_course.php?id=<?= $c->getId()?>">Join</a>
						<?php
							if ($loggedUser->getIsAdmin()) :
						?>
							| <a href="edit_course.php?id=<?= $c->getId()?>">Edit</a> |
							<a href="delete_course.php?id=<?= $c->getId()?>">Delete</a>
						<?php
							endif;
						endif;
					?>
				</article>

			<?php endforeach; ?>
		</section>
	</div>

<?php require '/includes/footer.php' ?>