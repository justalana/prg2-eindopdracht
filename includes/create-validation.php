<?php

$form_filled = false;
$errors = [];
    //Check if data is valid & generate error if not so
    if (empty($title)) {
        $errors['title'] = "Title cannot be empty";
    } if (empty($author)) {
        $errors['author'] = "Author cannot be empty";
    } if (empty($genre)) {
        $errors['genre'] = "Genre cannot be empty";
    } if (empty($pages)) {
        $errors['pages'] = "Pages cannot be empty";
    } if (empty($year)) {
        $errors['year'] = "Year cannot be empty";
    } else {
        $form_filled = true;
        return;
    }

