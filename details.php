<?php
//check if id is valid and exists
//if not send back to index
if (!isset($_GET['id']) || $_GET['id'] == '') {
    header(header: 'Location: index.php');
    exit;
}
//save id in variable
$id = $_GET['id'];

//connection to database
/** @var mysqli $db */
require_once 'includes/database.php';

//select the correct book from databse using query and id
$query = 'SELECT * FROM book WHERE id ='.$id;
$result = mysqli_query($db, $query)
or die('Error '.mysqli_error($db).' with query '.$query);

//check if the id is valid in the database
//if not send back to index
if(mysqli_num_rows($result) != 1) {
    header(header: 'Location: index.php');
    exit;
}

//save book details in array
$book = mysqli_fetch_assoc($result);

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
    <title>Details [ALBUM NAME] | Music Collection</title>
</head>
<body>
<div class="container px-4">
    <div class="columns is-centered">
        <div class="column is-narrow">
            <h2 class="title mt-4"><?= htmlentities($book['title'])?> details</h2>
            <section class="content">
                <ul>
                    <li>Author: <?= htmlentities($book['author'])?></li>
                    <li>Genre: <?= htmlentities($book['genre'])?></li>
                    <li>Pages: <?= htmlentities($book['pages'])?></li>
                    <li>Year: <?= htmlentities($book['year'])?></li>
                </ul>
            </section>
            <div>
                <a class="button" href="index.php">Go back to the list</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>