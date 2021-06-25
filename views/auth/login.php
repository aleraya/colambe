<?php

use App\Connection;
use App\HTML\Form;
use App\Model\User;
use App\Table\Exception\NotFoundException;
use App\Table\UserTable;

$title = "Connexion | Colambe";
$user = new User();

$errors = [];

if (!empty($_POST)) {   
    $user -> setUsername($_POST['username']);
    $errors['password'] = 'Identifiant ou mot de passe incorrect';
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $pdo = Connection::getPDO();
        $table = new UserTable($pdo);
        try {
            $u = $table->findByUsername($_POST['username']); 
            if (password_verify($_POST['password'], $u->getPassword()) === true) {
                header("Location:". $router->url('admin_events'));
                exit();
            };
        } catch (NotFoundException $e) {
        }
    }
}


$form = new Form($user, $errors);
?>

<article class='l-main__detail'>
    <h1 class='prestation-title'>Se connecter</h1>
    <form action="" method='POST'>
        <?= $form->input('username', 'Nom utilisateur', true); ?>
        <?= $form->input('password', 'Mot de passe', true); ?>
        <button type="submit">Se connecter</button>
    </form>
</article>