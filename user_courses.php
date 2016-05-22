<?php
    require '/includes/header.php';
    require '/includes/sidebar.php';
    require '/filters/filter.php';
    require '/models/course.php';
    require '/repositories/users_courses_repository.php';
?>

<div class="right">
    <section id="courses">
        <h2>My Courses</h2>
            <?php
                $usersCoursesRepo = new UsersCoursesRepository();
                $asignedCourses = $usersCoursesRepo->getCoursesByUserId(intval($_SESSION["loggedUserId"]));
                foreach ($asignedCourses as $c) :
            ?>

                <article class="course-content">
                    <h3><?= $c->getTitle() ?></h3>
                    <p><?= $c->getContent() ?></p>
                </article>

            <?php endforeach; ?>
    </section>
</div>

<?php require '/includes/footer.php' ?>