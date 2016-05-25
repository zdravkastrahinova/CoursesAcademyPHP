<?php
    require '/includes/header.php';
    require '/includes/sidebar.php';
    require '/filters/access_filter.php';
    require '/repositories/comments_repository.php';

    $commentsRepo = new CommentsRepository();
    $comment = $commentsRepo->getById($_GET["id"]);

    if ($comment == null) {
        header("Location: courses.php");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') :

        $comment->setTitle(htmlspecialchars(trim($_POST["title"])));
        $comment->setContent(htmlspecialchars(trim($_POST["content"])));

        $commentsRepo->update($comment);
        header("Location: comments.php?course_id=".$comment->getCourseId());
    else :
?>

        <div class="right">
            <h3>Edit course</h3>
            <div class="form">
                <form method="POST">
                    <input type="text" name="title" value="<?= $comment->getTitle() ?>" required /> <br>
                    <textarea name="content" required ><?= $comment->getContent() ?></textarea> </br  >
                    <input type="submit" class="submit" value="Edit course" />
                </form>
            </div>
        </div>

<?php
    endif;
    require '/includes/footer.php'; ?>