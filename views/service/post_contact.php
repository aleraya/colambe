<?php

use App\Validators\ContactValidator;

$errors = [];

$v = new ContactValidator($_POST);
$validation = $v->validate();

session_start();
if (!$validation) {
    $_SESSION['errors'] = $v->errors();
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
