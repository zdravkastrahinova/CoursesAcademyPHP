<?php
    require 'includes/header.php';
    require 'includes/sidebar.php';
    require 'repositories/comments_repository.php';
    require 'repositories/courses_repository.php';
    require 'repositories/users_repository.php';

    if (isset($_GET["course_id"])) :
        $coursesRepo = new CoursesRepository();
        $course = $coursesRepo->getById($_GET["course_id"]);

        if ($course == null) {
            header("Location: courses.php");
            exit();
        }
?>
        <div class="right">
            <section id="comments">
                <h2>List Comments for course "<?= $course->getTitle() ?>"</h2>
                <?php
                    $loggedUser = null;
                    $usersRepo = new UsersRepository();

                    if (isset($_SESSION["loggedUserId"])) {
                        $loggedUser = $usersRepo->getById($_SESSION["loggedUserId"]);

                        if ($loggedUser->getIsAdmin() == true) {
                           echo '<a href="add_comment.php?course_id='.$course->getId().'"><h3>Add new comment</h3></a>';
                        }
                    }

                    $commentsRepo = new CommentsRepository();
                    $comments = $commentsRepo->getCommentsByCourseId($_GET["course_id"]);

                    $user = new User();
                    foreach($comments as $comment):
                        $user = $usersRepo->getById($comment->getUserId());

                ?>
                    <article class="comment-content">
                        <h3><?= $comment->getTitle() ?> <span>posted by: <?= $user->getUsername() ?></span></h3>
                        <p><?= $comment->getContent() ?></p>
                        <?php
                            if ($loggedUser != null && $loggedUser->getIsAdmin() == true) :
                        ?>
                            <a href="edit_comment.php?id=<?= $comment->getId()?>">Edit</a> |
                            <a href="delete_comment.php?id=<?= $comment->getId()?>">Delete</a>
                        <?php
                            endif;
                        ?>
                    </article>
                <?php endforeach; ?>
            </section>
        </div>
<?php
    else:
        header("Location: courses.php");
        exit();

    endif;

    require 'includes/footer.php';
?>