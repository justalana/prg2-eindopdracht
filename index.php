<?php
/** @var mysqli $db */
// Setup connection with database
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
    <div>
        <a class="button" href="create.php">Add new book</a>
    </div>
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
                    <th></th>
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
                        <td><?= $book['title'] ?></td>
                        <td><?= $book['author'] ?></td>
                        <td><?= $book['genre'] ?></td>
                        <td><?= $book['pages'] ?></td>
                        <td><?= $book['year'] ?></td>
                        <td><a href="details.php?id=<?= $book['id'] ?>">Details</a></td>
                        <td><a href="edit.php?id=<?= $book['id'] ?>">Edit</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <a class="button" href="login.php">Log out</a>
    </div>
</div>
</body>
</html>