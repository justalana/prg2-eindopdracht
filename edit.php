<?php
//check if user is logged in
//if user tries to enter this page while not logged in it sends them back to index
require_once 'includes/secure.php';

//Check if ID is valid
if (!isset($_GET['id']) || $_GET['id'] == '') {
    header(header: 'Location: index.php');
    exit;
}
$id = $_GET['id'];

//connection to database
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


//Error bericht aanpassen zodat die in html staat ipv de php
//variabelen apart aanpassen ipv in 1 statement
//check if form is submitted
if(isset($_POST['submit'])) {

//if form is submitted get the variables from the post
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $author = mysqli_real_escape_string($db, $_POST['author']);
    $genre = mysqli_real_escape_string($db, $_POST['genre']);
    $pages = mysqli_real_escape_string($db, $_POST['pages']);
    $year = mysqli_real_escape_string($db, $_POST['year']);
//check if the form was filled in correctly
// if not show an error
    require_once 'includes/form-validation.php';
    /** @var mysqli $form_filled */
 if ($form_filled) {
        $query = "UPDATE book 
                SET `title`='$title',`author`='$author',`genre`='$genre',`pages`=$pages,`year`=$year   
                WHERE id =" .$id;
        $result = mysqli_query($db, $query)
        or die('Error '.mysqli_error($db).' with query '.$query);

        header(header: 'Location: index.php');
        exit;
    }
}
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Music Collection Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
<div class="container px-4">

    <section class="columns is-centered">
        <div class="column is-10">
            <h2 class="title mt-4">Edit <?= $book['title']?></h2>

            <form class="column is-6" action="" method="post">

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="name">Name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="title" type="text" name="title" value="<?= $book['title']?>"/>
                            </div>
                            <?php if(isset($titleError)) { ?>
                                <p class="help is-danger">
                                    <?= $titleError ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="name">Artist</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="author" type="text" name="author" value="<?= $book['author']?>"/>
                            </div>
                            <?php if(isset($authorError)) { ?>
                                <p class="help is-danger">
                                    <?= $authorError ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="name">Genre</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <select class="input" name="genre">
                                    <option value="<?= $book['genre']?>"><?= $book['genre']?></option>
                                    <option value="Romance">Romance</option>
                                    <option value="Fantasy">Fantasy</option>
                                    <option value="Young Adult">Young Adult</option>
                                    <option value="LGBTQIA+">LGBTQIA+</option>
                                    <option value="Science-Fiction">Science-Fiction</option>
                                    <option value="Adventure">Adventure</option>
                                    <option value="Non-Fiction">Non-Fiction</option>
                                    <option value="Greek Mythology">Greek Mythology</option>
                                </select>
                            </div>
                            <?php if(isset($genreError)) { ?>
                                <p class="help is-danger">
                                    <?= $genreError ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="name">Year</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="pages" type="number" name="pages" value="<?= $book['pages']?>"/>
                            </div>
                            <?php if(isset($pagesError)) { ?>
                                <p class="help is-danger">
                                    <?= $pagesError ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="name">Tracks</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="year" type="number" name="year" value="<?= $book['year']?>"/>
                            </div>
                            <?php if(isset($yearError)) { ?>
                                <p class="help is-danger">
                                    <?= $yearError ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <button class="button is-link is-fullwidth" type="submit" name="submit">Save</button>
                    </div>
                </div>
            </form>

            <a class="button mt-4" href="index.php">&laquo; Go back to the list</a>
        </div>
    </section>
</div>
</body>
</html>
