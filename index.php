<?php
//check if user is logged in
session_start();
$loggedin = $_SESSION['loggedin'];

// Setup connection with database
/** @var mysqli $db */
require_once 'includes/database.php';

// Select all the albums from the database
$query = "SELECT * FROM book";
$result = mysqli_query($db, $query)
or die('Error '.mysqli_error($db).' with query '.$query);

// Store the albums in an array
$books = [];
while($row = mysqli_fetch_assoc($result))
{
    $books[] = $row;
}

// Close the connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Music Collection</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4">Book Collection</h1>
    <hr>
<!--    only show this button if user is logged in-->
    <?php if ($loggedin) { ?>
    <div>
        <a class="button" href="create.php">Add new book</a>
    </div>
    <?php } ?>
    <div class="columns is-centered">
        <div class="column is-narrow">

            <table class="table is-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Pages</th>
                    <th>Year</th>
                    <th>Details</th>
                    <?php if ($loggedin) { ?>
                    <th>Edit</th>
                    <th>Delete</th>
                    <?php } ?>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="9" class="has-text-centered">&copy; My Collection</td>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($books as $index => $book) { ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlentities($book['title'])  ?></td>
                        <td><?= htmlentities($book['author']) ?></td>
                        <td><?= htmlentities($book['genre']) ?></td>
                        <td><?= htmlentities($book['pages']) ?></td>
                        <td><?= htmlentities($book['year']) ?></td>
                        <td><a href="details.php?id=<?= $book['id'] ?>">Details</a></td>
                        <!--    only show these links if user is logged in-->
                        <?php if ($loggedin) { ?>
                            <td><a href="edit.php?id=<?= $book['id'] ?>">Edit</a></td>
                            <td><a href="delete.php?id=<?= $book['id'] ?>">Delete</a></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<!--    show logout button is user is logged in-->
    <?php if ($loggedin) { ?>
    <div>
        <a class="button" href="login.php">Logout</a>
    </div>
    <?php } else { ?>
<!--    show login button if user is not logged in-->
    <div>
        <a class="button" href="login.php">Login to edit this table</a>
    </div>
    <?php } ?>
</div>
</body>
</html>