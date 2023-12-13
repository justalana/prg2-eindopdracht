<?php
//check if user is logged in
//if user tries to enter this page while not logged in it sends them back to index
require_once 'includes/secure.php';

//connection to database
/** @var mysqli $db */
require_once 'includes/database.php';
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
        //if form is filled correctly send info to database with query
        $query = "INSERT INTO `book`(`title`, `author`, `genre`, `pages`, `year`) 
            VALUES ('$title', '$author', '$genre', $pages, $year)";
        $result = mysqli_query($db, $query)
        or die('Error ' . mysqli_error($db) . ' with query ' . $query);

        //send user back to index when done
        header(header: 'Location: index.php');
        exit;
    }
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
            <h2 class="title mt-4">Add new book</h2>

            <form class="column is-6" action="" method="post">

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="name">Title</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
<!--                                set value to value given with post-->
                                <input class="input" id="title" type="text" name="title" value="<?= isset($_POST['title']) ? $_POST['title'] : ''; ?>"/>
                            </div>
<!--                            if input is not filled, give error-->
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
                        <label class="label" for="artist">Author</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="author" type="text" name="author" value="<?= isset($_POST['author']) ? $_POST['author'] : ''; ?>"/>
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
                        <label class="label" for="genre">Genre</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <select class="input" name="genre">
                                    <option value=""></option>
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
                        <label class="label" for="year">Pages</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="pages" type="number" name="pages" value="<?= isset($_POST['pages']) ? $_POST['pages'] : ''; ?>"/>
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
                        <label class="label" for="tracks">Year</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input" id="year" type="number" name="year" value="<?= isset($_POST['year']) ? $_POST['year'] : ''; ?>"/>
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
