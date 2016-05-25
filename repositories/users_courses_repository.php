<?php
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

        function deleteAssignedCoursesByUserId($user_id) {
            $query = "DELETE FROM `users_courses` WHERE user_id=?";

            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $user_id);

            $stmt->execute();
        }

        function checkIfCourseIsAssigned($user_id, $course_id) {
            $founded = false;
            $asignedCourses = $this->getCoursesByUserId($user_id);

            foreach ($asignedCourses as $a) {
                if ($a->getId() == $course_id) {
                    $founded = true;
                }
            }

            return $founded;
        }
    }