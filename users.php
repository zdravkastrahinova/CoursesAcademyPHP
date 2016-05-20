<?php
    require '/includes/header.php';
    require '/includes/sidebar.php';
    require '/filters/access_filter.php';
    require '/repositories/users_repository.php';
    require '/repositories/users_courses_repository.php';
?>

    <div class="right">
        <section id="users">
            <h2>List Users</h2>
            <a href="registration.php"><h3>Register new user</h3></a>

            <?php
                $usersRepo = new UsersRepository();
                $users = $usersRepo->getAll();
                foreach ($users as $u) :
            ?>

                <article class="user-content">
                    <div class="user-data">
                        <h3><?= $u->getUsername() ?></h3>
                        <a href="edit_user.php?id=<?= $u->getId()?>">Edit</a>
                        <a href="delete_user.php?id=<?= $u->getId()?>">Delete</a>
                    </div>
                    <ul>
                        <h4>Joined Courses</h4>
                        <?php
                            $usersCoursesRepo = new UsersCoursesRepository();
                            $asignedCourses = $usersCoursesRepo->getCoursesByUserId($u->getId());
                            foreach ($asignedCourses as $a) :
                            ?>
                                <li><?= $a->getTitle() ?></li>
                            <?php
                                endforeach;
                            ?>
                    </ul>
                </article>

            <?php endforeach; ?>
        </section>
    </div>

<?php require '/includes/footer.php' ?>