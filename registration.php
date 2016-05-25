<?php 
    require '/includes/header.php';
    require '/includes/sidebar.php';
    require '/repositories/users_repository.php';

    $errorMsg = "";

    if ($_SERVER["REQUEST_METHOD"] === 'POST') :
        $username = htmlspecialchars(trim($_POST["username"]));
        $password = htmlspecialchars(trim($_POST["password"]));
        $rePassword = htmlspecialchars(trim($_POST["re-password"]));

        if (empty($username) || empty($password) || empty($rePassword)) {
            $errorMsg = "All fields are required.";
            header("Location: registration.php?errorMsg=$errorMsg");
        }

        if ($password !== $rePassword) {
            $errorMsg = "Passwords do not match.";
            header("Location: registration.php?errorMsg=$errorMsg");
        }

        $usersRepo = new UsersRepository();

        $users = $usersRepo->getAll();
        foreach ($users as $u) {
            if ($u->getUsername() == $username) {
                $errorMsg = "Username is already taken.";
                header("Location: registration.php?errorMsg=$errorMsg");
            }
        }

        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);

        $usersRepo->insert($user);

        header("Location: login.php");
    else :
?>

    <div class="right">
        <h2>Register</h2>
        <div class="form">
            <form method="POST">
                <p class="error">
                    <?php
                        if (isset($_SESSION["loggedUserId"]) && $_SESSION["loggedUserIsAdmin"] == false) {
                            header("Location: index.php");
                        }

                        if (isset($_GET["errorMsg"])) {
                            echo $_GET["errorMsg"];
                        }
                    ?>
                </p>
                <input type="text" name="username" placeholder="Enter username..." required /> <br>
                <input type="password" name="password" placeholder="Enter password..." required /> <br>
                <input type="password" name="re-password" placeholder="Repeat password..." required /> <br>
                <input type="submit" class="submit" value="Register" />
            </form>
        </div>
    </div>

<?php
    endif;
    require '/includes/footer.php';
?>