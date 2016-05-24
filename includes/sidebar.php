<aside id="sidebar">
    <?php
        if(isset($_SESSION["loggedUserId"])) {
            echo '<div id="greeting"><h3>Hello, <span>'. $_SESSION["loggedUserUsername"] .'</span></h3></div>';
        }
    ?>
    <nav id="main-nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="courses.php">List All Courses</a></li>
            <?php
            if (isset($_SESSION["loggedUserId"])) :
                echo '<li><a href="user_courses.php">My courses</a></li>';

                if ($_SESSION["loggedUserIsAdmin"]) {
                    echo '<li><a href="users.php">List Users</a></li>';
                }
                ?>

                <li><a href="logout.php">Logout</a></li>
                <?php
            else:
                ?>
                <li><a href="registration.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
                <?php
            endif;
            ?>
        </ul>
    </nav>
</aside>
