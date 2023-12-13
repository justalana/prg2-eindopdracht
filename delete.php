<?php
//check if user is logged in
require_once 'includes/secure.php';

//Check if ID is valid
if (!isset($_GET['id']) || $_GET['id'] == '') {
    header(header: 'Location: index.php');
    exit;
}
$id = $_GET['id'];

/** @var mysqli $db */
require_once 'includes/database.php';

//check if book exists
$query = 'SELECT * FROM book WHERE id ='.$id;
$result = mysqli_query($db, $query)
or die('Error '.mysqli_error($db).' with query '.$query);

if(mysqli_num_rows($result) != 1) {
    header(header: 'Location: index.php');
    exit;
}

if(isset($_POST['submit'])) {
    $query = "DELETE FROM `book` WHERE id =" .$id;
    echo $query;
    $result = mysqli_query($db, $query)
    or die('Error '.mysqli_error($db).' with query '.$query);

    header(header: 'Location: index.php');
    exit;
}
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Muziekalbums - Create</title>
</head>
<body>
<div class="container px-4">

    <section class="columns is-centered">
        <div class="column is-10">
            <h2 class="title mt-4">Are you sure you want to delete this book?</h2>

            <form class="column is-6" action="" method="post">

                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <button class="button is-link is-fullwidth" type="submit" name="submit">Delete book</button>
                    </div>
                </div>
            </form>

            <a class="button mt-4" href="index.php">&laquo; Go back to the list</a>
        </div>
    </section>
</div>
</body>
</html>
