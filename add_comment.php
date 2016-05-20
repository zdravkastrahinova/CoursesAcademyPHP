<?php
	require '/includes/header.php';
	require '/includes/sidebar.php';
	require  '/filters/access_filter.php';
?>

<?php
    require '/repositories/comments_repository.php';
    require '/repositories/courses_repository.php';
    $errorMsg = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') :
        $title = htmlspecialchars(trim($_POST["title"]));
        $content = htmlspecialchars(trim($_POST["content"]));

        $coursesRepo = new CoursesRepository();
        $course = $coursesRepo->getById($_GET["course_id"]);

        if ($course == null) {
            header ("Location: courses.php");
            exit();
        }

        if (empty($title) || empty($content)) {
            $errorMsg = "All fields are required.";
            header("Location: add_comment.php?errorMsg=$errorMsg");
            exit();
        }

        $commentsRepo = new CommentsRepository();

        $comment = new Comment();
        $comment->setTitle($title);
        $comment->setContent($content);
        $comment->setCourseId($course->getId());
        $comment->setUserId($_SESSION["loggedUserId"]);

        $commentsRepo->insert($comment);

        header("Location: comments.php?course_id=".$comment->getCourseId());
    else :
?>

        <div class="right">
            <h3>Add new comment</h3>
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
                    <textarea name="content" placeholder="Enter content..." required></textarea> <br>
                    <input type="submit" class="submit" value="Add comment" />
                </form>
            </div>
        </div>

    <?php endif; ?>

<?php require '/includes/footer.php'; ?>        