<?php
$form_filled = false;

    //Check if data is valid & generate error if not so
    if ($title == "") {
        $titleError = "Title cannot be empty";
    } if ($author == "") {
        $authorError = "Author cannot be empty";
    } if ($genre == "") {
        $genreError = "Genre cannot be empty";
    } if ($pages == "" || !is_numeric($pages)) {
        $pagesError = "Must be a valid number";
    } if ($year == "" || !is_numeric($year)) {
        $yearErrors = "Must be a valid number";
    } else {
        $form_filled = true;
        return;
    }

