<?php
    require 'models/user.php';

    class UsersRepository
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

        public function getById($id) {
            $users = $this->getAll();

            foreach ($users as $u) {
                if ($u->getId() == $id) {
                    return $u;
                }
            }

            return null;
        }

        public function getByUsernameAndPassword($username, $password) {
            $users = $this->getAll();

            foreach ($users as $u) {
                if ($u->getUsername() == $username && $u->getPassword() == $password) {
                    return $u;
                }
            }

            return null;
        }

        public function getAll() {
            $result = $this->connection->query("SELECT * FROM `users`");

            $users = array();
            while ($row = $result->fetch_assoc()) {
                $user = new User();
                $user->setId($row["id"]);
                $user->setUsername($row["username"]);
                $user->setPassword($row["password"]);
                $user->setIsAdmin($row["isAdmin"]);

                array_push($users, $user);
            }

            return $users;
        }

        function insert($user) {
            $query = "INSERT INTO `users` (`username`, `password`) VALUES (?,?)";

            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ss", $user->getUsername(), $user->getPassword());

            $stmt->execute();
        }

        function update($user) {
            $query = "UPDATE `users` SET username=?, password=?, isAdmin=? WHERE id=?";

            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssii", $user->getUsername(), $user->getPassword(), $user->getIsAdmin(), $user->getID());

            $stmt->execute();

        }

        function delete($id) {
            $query = "DELETE FROM `users` WHERE id=?";

            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);

            $stmt->execute();
        }
    }