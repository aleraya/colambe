<?php

$errors = [];

if (!array_key_exists('name', $_POST) || $_POST['name'] == '') {
    $errors['name'] = "Nom obligatoire";
} elseif (strlen($_POST['name']) < 2 || strlen($_POST['name']) > 30 ) {
    $errors['name'] = "Le nom doit contenir entre 2 et 30 caractères";
}

if (!array_key_exists('firstName', $_POST) || $_POST['firstName'] == '') {
    $errors['firstName'] = "Prénom obligatoire";
} elseif (strlen($_POST['firstName']) < 2 || strlen($_POST['firstName']) > 30 ) {
    $errors['firstName'] = "Le prénom doit contenir entre 2 et 30 caractères";
}

if (!array_key_exists('email', $_POST) || $_POST['email'] == '') {
    $errors['email'] = "Email obligatoire";
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Email invalide";
}

if (!array_key_exists('tel', $_POST) || $_POST['tel'] == '') {
    $errors['tel'] = "Téléphone obligatoire";
} elseif (!preg_match("/^(0|\\+33)[1-9]([-. ]?[0-9]{2}){4}$/", $_POST['tel'] )) {
    $errors['tel'] = "Téléphone incorrect";
}

if (!array_key_exists('message', $_POST) || $_POST['message'] == '') {
    $errors['message'] = "Message obligatoire";
}

session_start();
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['$_POST'] = $_POST;
    header('Location: ' . $router->url('contact'));
    //header('Location: ' . $_SERVER['HTTP_ORIGIN'] . '/contact');
} else {
    $message = nl2br($_POST['message']);
    $headers = "From: {$_POST['email']}";
    $subject = "Formulaire de contact de {$_POST['name']} {$_POST['firstName']} [{$_POST['tel']}]";
    mail("anne.leray8@gmail.com", $subject, $message, $headers);
    $_SESSION['success']= true;
    header('Location: ' . $router->url('contact'));
    //header('Location: ' . $_SERVER['HTTP_ORIGIN'] . '/contact');
}
