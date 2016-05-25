<?php
    require '/includes/header.php';
    require '/includes/sidebar.php';
    require '/repositories/users_repository.php';

    $errorMsg = "";

    if ($_SERVER["REQUEST_METHOD"] === 'POST') :
        $username = htmlspecialchars(trim($_POST["username"]));
        $password = htmlspecialchars(trim($_POST["password"]));

        if (empty($username) || empty($password)) {
            $errorMsg = "All fields are required.";
            header("Location: login.php?errorMsg=$errorMsg");
        }

        $usersRepo = new UsersRepository();
        $user = $usersRepo->getByUsernameAndPassword($username, $password);

        if ($user == null) {
            $errorMsg = "Invalid username or password.";
            header("Location: login.php?errorMsg=$errorMsg");
        }

        $_SESSION["loggedUserId"] = $user->getId();
        $_SESSION["loggedUserUsername"] = $user->getUsername();
        $_SESSION["loggedUserIsAdmin"] = $user->getIsAdmin();

        header("Location: index.php");
    else :
?>

    <div class="right">
        <h2>Login</h2>
        <div class="form">
            <form method="POST">
                <p class="error">
                    <?php
                        if (isset($_SESSION["loggedUserId"])) {
                            header("Location: index.php");
                        }
                    
                        if (isset($_GET["errorMsg"])) {
                            echo $_GET["errorMsg"];
                        }
                    ?>
                </p>
                <input type="text" name="username" placeholder="Enter username..." required /> <br>
                <input type="password" name="password" placeholder="Enter password..." required /> <br>
                <input type="submit" class="submit" value="Login" />
            </form>
        </div>
    </div>

<?php
    endif;
    require '/includes/footer.php';
?>