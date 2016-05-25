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
                $assignedCourses = $usersCoursesRepo->getCoursesByUserId(intval($_SESSION["loggedUserId"]));

                if(count($assignedCourses) == 0) :
                    echo '<div class="alert-info">You have not joined to any course yet.</div>';
                else :
                    foreach ($assignedCourses as $c) :
            ?>

                    <article class="course-content">
                        <h3><?= $c->getTitle() ?></h3>
                        <p><?= $c->getContent() ?></p>
                    </article>

            <?php
                    endforeach;
                endif;
            ?>
    </section>
</div>

<?php require '/includes/footer.php' ?>