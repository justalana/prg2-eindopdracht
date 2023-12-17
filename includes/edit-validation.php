<?php
//connection to database
$id = $_GET['id'];

/** @var mysqli $db */
require_once 'includes/database.php';

//get book from databse using query
$query = 'SELECT * FROM book WHERE id ='.$id;
$result = mysqli_query($db, $query)
or die('Error '.mysqli_error($db).' with query '.$query);

//check if book exists in database
if(mysqli_num_rows($result) != 1) {
    header(header: 'Location: index.php');
    exit;
}
$book = mysqli_fetch_assoc($result);

$form_filled = false;
    //if the data in post is empty fill it with the old data from the database
    // this way the user will only have to fill in te input they want to change
    if (empty($title)) {
        $title = $book['title'];
    } if (empty($author)) {
        $author = $book['author'];
    } if (empty($genre)) {
        $genre = $book['genre'];
    } if (empty($pages)) {
        $pages = $book['pages'];
    } if (empty($year)) {
        $year = $book['year'];
    }

$form_filled = true;
return;
