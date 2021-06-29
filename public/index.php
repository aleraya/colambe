<?php

use App\Router;

require '../vendor/autoload.php';

// $router = new AltoRouter();
define('DS', DIRECTORY_SEPARATOR);
define('VIEW_PATH', dirname(__DIR__) . '/views');
define('HOST', 'http://'.$_SERVER['HTTP_HOST'].'/');
define('EVENT_PATH', $_SERVER['DOCUMENT_ROOT'].  '/webroot/img/event/');   //C:...
define('EVENT_HOST', HOST.  '/webroot/img/event/');                        //http://...

define('DAY', 'Jour');
define('PRICETYPE', 'TypeTarif');


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

    // ADMIN
    // Root pour accéder à la partie connexion/déconnexion
    ->match('/login', 'auth/login', 'login')
    ->post('/logout', 'auth/logout', 'logout')
    // Gestion des événements
    ->get('/admin', 'admin/event/index', 'admin_events')
    ->match('/admin/event/[i:id]', 'admin/event/edit', 'admin_event')
    ->post('/admin/event/[i:id]/delete', 'admin/event/delete', 'admin_event_delete')
    ->match('/admin/event/new', 'admin/event/new', 'admin_event_new')
    // Gestion des tables
    ->get('/admin/tables', 'admin/config/index', 'admin_tables')
    ->match('/admin/table/new', 'admin/config/new', 'admin_table_new')
    ->get('/admin/table/[a:table]', 'admin/config/editTable', 'admin_table_edit')
    ->post('/admin/table/[a:table]/delete', 'admin/config/deleteTable', 'admin_table_delete')
    ->match('/admin/table/new/[a:table]', 'admin/config/new', 'admin_table_newTable')
    ->match('/admin/table/[a:table]/[i:id]', 'admin/config/edit', 'admin_table_editTable')
    ->post('/admin/table/[a:table]/[i:id]/delete', 'admin/config/delete', 'admin_table_deleteTable')
    // Gestion des créneaux
    ->get('/admin/slots', 'admin/slot/index', 'admin_slots')
    ->match('/admin/slot/[i:id]', 'admin/slot/edit', 'admin_slot')
    ->match('/admin/slot/new', 'admin/slot/new', 'admin_slot_new')
    ->post('/admin/slot/[i:id]/delete', 'admin/slot/delete', 'admin_slot_delete')
    // Gestion des rubriques de tarifs
    ->get('/admin/pricesections', 'admin/pricesection/index', 'admin_pricesections')
    ->match('/admin/pricesection/[i:id]', 'admin/pricesection/edit', 'admin_pricesection')
    ->post('/admin/pricesection/[i:id]/delete', 'admin/pricesection/delete', 'admin_pricesection_delete')
    ->match('/admin/pricesection/new', 'admin/pricesection/new', 'admin_pricesection_new')
    // Gestion des tarifs
    ->get('/admin/prices', 'admin/price/index', 'admin_prices')


    ->run();

// Demande au router si l'url saisie correspond à une des routes
// $match = $router->match();
// Récupération de la cible, la closure, la fonction require et appelle de la fonction par les ()
// $match['target']();