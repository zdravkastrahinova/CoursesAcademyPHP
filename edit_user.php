<?php
    require '/includes/header.php';
    require '/includes/sidebar.php';
    require '/filters/access_filter.php';
?>

<?php
    require '/repositories/users_repository.php';
    $usersRepo = new UsersRepository();
    $user = $usersRepo->getById($_GET["id"]);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') :

        $user->setUsername(htmlspecialchars(trim($_POST["username"])));
        $user->setIsAdmin(($_POST["role"]));

        $usersRepo->update($user);
        header("Location: users.php");
    else :
?>

    <div class="right">
        <h3>Edit user</h3>
        <div class="form">
            <form method="POST">
                <input type="text" name="username" value="<?= $user->getUsername() ?>" required /> <br>
                <select name="role">
                    <option value="0" <?php if($user->getIsAdmin() == 0) {echo 'selected';} ?> > User </option>
                    <option value="1" <?php if($user->getIsAdmin() == 1) {echo 'selected';} ?> > Admin </option>
                </select> <br>
                <input type="submit" class="submit" value="Edit user" />
            </form>
        </div>
    </div>

    <?php endif; ?>

<?php require '/includes/footer.php'; ?>