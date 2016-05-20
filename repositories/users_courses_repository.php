<?php
    require 'models/course.php';

    class UsersCoursesRepository {

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

        public function getCoursesByUserId($user_id) {
            $result = $this->connection->query("SELECT * FROM courses c JOIN users_courses uc ON c.id = uc.course_id WHERE uc.user_id = " . $user_id);

            $courses = array();
            while ($row = $result->fetch_assoc()) {
                $course = new Course();
                $course->setId($row["id"]);
                $course->setTitle($row["title"]);
                $course->setContent($row["content"]);

                array_push($courses, $course);
            }

            return $courses;
        }

        function insert($user_id, $course_id)
        {
            $query = "INSERT INTO `users_courses` (`user_id`, `course_id`) VALUES (?, ?)";

            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ii", $user_id, $course_id);

            $stmt->execute();
        }
    }
?>