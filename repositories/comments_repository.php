<?php
    require 'models/comment.php';

    class CommentsRepository
    {
        private $connection;

        function __construct()
        {
            $url = 'localhost';
            $dbUsername = 'root';
            $dbPassword = '';
            $dbName = 'coursesacademy';

            $this->connection = new mysqli($url, $dbUsername, $dbPassword, $dbName);
            mysqli_set_charset($this->connection, 'utf8');
        }

        function getById($id) {
            $comments = $this->getAll();

            foreach($comments as $c) {
                if($c->getId() == $id){
                    return $c;
                }
            }

            return null;
        }

        function getCommentsByCourseId($course_id) {
            $allComments = $this->getAll();
            $comments = array();

            foreach($allComments as $c){
                if($c->getCourseId() == $course_id) {
                    array_push($comments, $c);
                }
            }

            return $comments;
        }

        function getAll() {
            $result = $this->connection->query("SELECT * FROM `comments`");

            $comments = array();
            while($row = $result->fetch_assoc()) {
                $comment = new Comment();
                $comment->setId($row["id"]);
                $comment->setCourseId($row["course_id"]);
                $comment->setUserId($row["user_id"]);
                $comment->setTitle($row["title"]);
                $comment->setContent($row["content"]);

                array_push($comments, $comment);
            }

            return $comments;
        }

        function insert($comment) {
            $query = "INSERT INTO `comments`(`course_id`, `user_id`, `title`, `content`) VALUES (?, ?, ?, ?)";

            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("iiss", $comment->getCourseId(), $comment->getUserId(), $comment->getTitle(), $comment->getContent());

            $stmt->execute();
        }

        function update($comment) {
            $query = "UPDATE `comments` SET title=?, content=? WHERE id=?";

            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssi", $comment->getTitle(), $comment->getContent(), $comment->getId());

            $stmt->execute();
        }

        function delete($id)
        {
            $query = "DELETE FROM `comments` WHERE id=?";

            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);

            $stmt->execute();
        }

        function deleteAllByCourseId($course_id) {
            $query = "DELETE FROM `comments` WHERE course_id=?";

            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $course_id);

            $stmt->execute();
        }
    }