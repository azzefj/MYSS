<?php
include_once "header.php";
include_once "banner.php";

require_once "../Controller/connection.php";
require_once "../Controller/Controller.php";
require_once "../Model/UserQuery.php";

function register()
{
    try {
        if ((!empty($_POST['username'])) &&
            (!empty($_POST['email'])) &&
            (!empty($_POST['password'])) &&
            (!empty($_POST['name'])) &&
            (!empty($_POST['birthday']))) {

            $controller = new Controller();

            if ($controller->isUsernameTaken($_POST['username']) == false) {
                if ($controller->isEmailTaken($_POST['email']) == false) {
                    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

                        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                        $controller->registerNewUser($_POST['username'],
                            $_POST['email'],
                            $password,
                            $_POST['name'],
                            $_POST['birthday']);

                        header('Location: ..\View\login.php');
                    } else {
                        return "Cannot register. The email is invalid.";
                    }
                } else {
                    return "Cannot register. The email has been taken";
                }
            } else {
                return "Cannot register. The username has been taken.";
            }
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

?>

<section class="login">
    <?php
    $message = register();
    if (!empty($message)): ?>
        <p>
        <center><?= $message ?></center></p>
    <?php endif; ?>
    <div class="container" style="padding-top: 150px;">
        <center>
            <div class="col-md-6"
                 style="box-shadow: 0px 20px 30px rgba(0, 35, 71, 0.1);background: #ffffff;height:490px;">
                <br>
                <h1>MYSS</h1>
                <form action="signup.php" method="post" class="form-signin">
                    <h3 class="form-signin-heading">Register</h3><br>
                    <div class="form-group">
                        <input id="username" name="username" type="text" class="form-control" required
                               placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input id="email" name="email" type="text" class="form-control" required placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input id="password" name="password" type="password" class="form-control" required
                               placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input id="name" name="name" type="text" class="form-control" required placeholder="Full name">
                    </div>
                    <div class="form-group">
                        <input id="birthday" name="birthday" type="date" parsley-trigger="change" required
                               class="form-control">
                    </div>
                    <button id="signinbtn" name="signinbtn" class="genric-btn info circle" type="submit"
                            value="register" onclick="register()">Sign up
                    </button>
                    <br>
                    <a class="btn" href="login.php" role="button">Already have an account? Log in here.</a>
                </form>
            </div>
        </center>
    </div>
</section>


<?php
include_once "footer.php";
?>
