<?php

use App\Connection;
use App\HTML\HTMLForm;
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
                session_start();
                $_SESSION['auth'] = $u->getId();
                header("Location:". $router->url('admin_events'));
                exit();
            };
        } catch (NotFoundException $e) {
        }
    }
}


$form = new HTMLForm($user, $errors);
?>

<article class='l-main__detail'>
    <h1 class='prestation-title'>Se connecter</h1>
    <?php if(isset($_GET['forbidden'])): ?>
        <div class="error">Vous ne pouvez pas accéder à cette page</div>
    <?php endif ?>
    <form action="/login" method='POST'>
        <?= $form->input('username', 'Nom utilisateur', true); ?>
        <?= $form->input('password', 'Mot de passe', true); ?>
        <button type="submit">Se connecter</button>
    </form>
</article>