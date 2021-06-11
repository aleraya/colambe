<?php

require '../vendor/autoload.php';

$router = new AltoRouter();

define('VIEW_PATH', dirname(__DIR__) . '/views');


// Création des routes
$router->map('GET', '/', function() {
    require VIEW_PATH . '/service/index.php';
});

$router->map('GET', '/californien', function() {
    require VIEW_PATH . '/service/californien.php';
});

$router->map('GET', '/contact', function() {
    require VIEW_PATH . '/service/contact.php';
});

$router->map('GET', '/entreprise', function() {
    require VIEW_PATH . '/service/entreprise.php';
});

$router->map('GET', '/evenementiel', function() {
    require VIEW_PATH . '/service/evenementiel.php';
});

$router->map('GET', '/massage-5-continents', function() {
    require VIEW_PATH . '/service/massage-5-continents.php';
});

$router->map('GET', '/qui-suis-je', function() {
    require VIEW_PATH . '/service/qui-suis-je.php';
});

$router->map('GET', '/shiatsu-sur-chaise', function() {
    require VIEW_PATH . '/service/shiatsu-sur-chaise.php';
});

$router->map('GET', '/tarifs', function() {
    require VIEW_PATH . '/service/tarifs.php';
});

// Demande au router si l'url saisie correspond à une des routes
$match = $router->match();
// Récupération de la cible, la closure, la fonction require et appelle de la fonction par les ()
$match['target']();