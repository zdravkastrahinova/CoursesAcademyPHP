<?php
	require 'models/course.php';

	class CoursesRepository
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

		function getById($id)
		{
			$courses = $this->getAll();

			foreach ($courses as $c) {
				if ($c->getId() == $id) {
					return $c;
				}
			}

			return null;
		}

		function getAll()
		{
			$result = $this->connection->query("SELECT * FROM `courses`");
			
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

		function insert($course)
		{
			$query = "INSERT INTO `courses` (`title`, `content`) VALUES (?, ?)";

			$stmt = $this->connection->prepare($query);
			$stmt->bind_param("ss", $course->getTitle(), $course->getContent());
			
			$stmt->execute();
		}

		function update($course)
		{
			$query = "UPDATE `courses` SET title=?, content=? WHERE id=?";

			$stmt = $this->connection->prepare($query);
			$stmt->bind_param("ssi", $course->getTitle(), $course->getContent(), $course->getId());

			$stmt->execute();
		}

		function delete($id) 
		{
			$query = "DELETE FROM `courses` WHERE id=?";
			
			$stmt = $this->connection->prepare($query);
			$stmt->bind_param("i", $id);

			$stmt->execute();
		}
	}