<?php

use App\Router;

require '../vendor/autoload.php';

// $router = new AltoRouter();

define('VIEW_PATH', dirname(__DIR__) . '/views');

/** A METTRE EN COMMENTAIRES POUR LA PROD PERMET D'AFFICHER ERREURS DANS UN FORMAT DETAILLE EN CAS DE PLANTAGE */
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
/** */


$router = new Router(VIEW_PATH);
// Création des routes
// $router->map('GET', '/', function() {
//     require VIEW_PATH . '/service/index.php';
// }, 'index');

//        root/url   arborescence  nom root  
$router
    ->get('/', 'service/index', 'home')
    ->get('/californien', 'service/californien', 'californien') 
    ->get('/contact', 'service/contact', 'contact')
    ->post('/post_contact', 'service/post_contact', 'post_contact')
    ->get('/entreprise', 'service/entreprise', 'entreprise')
    ->get('/evenementiel', 'service/evenementiel', 'evenementiel')
    ->get('/massage-5-continents', '/service/massage-5-continents', 'massage5Continents')
    ->get('/qui-suis-je', 'service/qui-suis-je', 'quiSuisJe')
    ->get('/shiatsu-sur-chaise', 'service/shiatsu-sur-chaise', 'shiatsuSurChaise')
    ->get('/tarifs', '/service/tarifs', 'price')

    ->run();

// Demande au router si l'url saisie correspond à une des routes
// $match = $router->match();
// Récupération de la cible, la closure, la fonction require et appelle de la fonction par les ()
// $match['target']();