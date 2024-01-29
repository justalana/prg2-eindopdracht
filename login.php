<?php
// required when working with sessions
session_start();

$_SESSION['loggedin'] = false;
// Stap 1: Kijk of de user is ingelogd
if($_SESSION['loggedin']){
    header("location: login.php");
    exit;
}

/** @var mysqli $db */
require_once 'includes/database.php';

$emailError = "";
$passwordError = "";
$details = [];
if (isset($_POST['submit'])) {

    // Get form data
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Server-side validation
    if ($email == "") {
        $emailError = "Field cannot be empty";
    } if ($password == "") {
        $passwordError = "Field cannot be empty";
    }

    if (empty($emailError) && empty($passwordError)) {
        // If data valid
        // SELECT the user from the database, based on the email address.
        $query = "SELECT `id`,`email`, `password` , `first_name`
            FROM users WHERE `email` = '$email'";
        $result = mysqli_query($db, $query)
        or die('Error '.mysqli_error($db).' with query '.$query);


        // check if the user exists
        if ($result) {
            $details = mysqli_fetch_assoc($result);
            // Get user data from result
            if (mysqli_num_rows($result) == 1) {
                //Get password and check if it is correct
                $hashed_password = $details['password'];
                // Check if the provided password matches the stored password in the database
                if (password_verify($password, $hashed_password)) {

                    // Store the user in the session
                    $_SESSION['loggedin'] = true;
                    $_SESSION['id'] = $details['id'];
                    $_SESSION['email'] = $details['email'];
                    $_SESSION['name'] = $details['first_name'];

                    //send user to index page
                    header("location: index.php");
                    exit;

                } else {
                    // error when password doesnt match with email
                    $errors['loginFailed'] = "Invalid password";
                }
                // Credentials not valid
            } else {
                //error incorrect log in
                // User doesn't exist
                $loginError = "Invalid username or password";
            }
        } else {
            echo "Oops! Something went wrong, try again.";
        }
    }


}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Log in</title>
</head>
<body>
<section class="section">
    <div class="container content">
        <h2 class="title">Log in</h2>

        <?php if (!$_SESSION['loggedin']) { ?>

        <section class="columns">
            <form class="column is-6" action="" method="post">

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="email">Email</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="email" type="text" name="email" value="<?= $email ?? '' ?>" />
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                            <?php if(isset($emailError)) { ?>
                                <p class="help is-danger">
                                    <?= $emailError ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="password">Password</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="password" type="password" name="password"/>
                                <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>

                                <?php if(isset($errors['loginFailed'])) { ?>
                                <div class="notification is-danger">
                                    <button class="delete"></button>
                                    <?=$errors['loginFailed']?>
                                </div>
                                <?php } ?>

                            </div>
                            <?php if(isset($passwordError)) { ?>
                                <p class="help is-danger">
                                    <?= $passwordError ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <button class="button is-link is-fullwidth" type="submit" name="submit">Log in With Email</button>
                    </div>
                </div>

            </form>
        </section>
        <?php if (!$_SESSION['loggedin']) { ?>
            <div class="field is-horizontal">
                <div class="field-label is-normal"></div>
                <div class="field-body">
                    <a href="register.php">
                        <button class="button is-link is-fullwidth" type="submit" name="register">Don't have an account? Register now</button>
                    </a>
                </div>
            </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <a href="index.php">
                            <button class="button is-link is-fullwidth" type="submit" name="index">Back to index</button>
                        </a>
                    </div>
                </div>
        <?php } ?>

        <?php } ?>




    </div>
</section>
</body>
</html>


