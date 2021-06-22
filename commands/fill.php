<?php

use App\Connection;

$pdo = Connection::getPDO();


require dirname(__DIR__).'/vendor/autoload.php';

$faker = Faker\Factory::create('fr_FR');

define('DS', DIRECTORY_SEPARATOR);

// Truncate supprime données d'une table sans supprimer la table
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0'); //Ignore ce qui est foreign_key
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('TRUNCATE TABLE event');
$pdo->exec('TRUNCATE TABLE slot');
$pdo->exec('TRUNCATE TABLE menu');
$pdo->exec('TRUNCATE TABLE price');
$pdo->exec('TRUNCATE TABLE pricecategory');
$pdo->exec('TRUNCATE TABLE pricetype');
$pdo->exec('TRUNCATE TABLE config');
$pdo->exec('TRUNCATE TABLE cardelement');
$pdo->exec('TRUNCATE TABLE paragraph');
$pdo->exec('TRUNCATE TABLE service');
$pdo->exec('TRUNCATE TABLE picture');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');


// Fonction pour supprimer extension d'un fichier.
function delExt ($file) {
    
    // cherche la postion du '.'  
    $position = strpos($file, ".");
    
    // enleve l'extention, tout ce qui se trouve apres le '.'
    return substr($file, 0, $position);
}

// Remplissage des images
$dir = dirname(__DIR__).DS.'public'.DS.'webroot'.DS.'img'.DS.'service';
if (is_dir($dir)) {
    if($dh = opendir($dir)) {
        $pictures=[];
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != "..") {
                $url = 'webroot/img/service/'.$file;
                $name = delExt($file);
                $pdo->exec("INSERT INTO picture SET 
                        name='{$file}', 
                        url='{$url}',
                        description='{$name}'");
            }  
            $pictures[] = $pdo -> lastInsertId();          
        }
    }
    closedir($dh);
}

// Remplissage des prestations, services

$services=[];

$pdo->exec("
    INSERT INTO service SET 
        name='Qui suis-je', 
        slug='qui-suis-je',
        summary='',
        picture_id = 5,
        order_nb=0,
        card_title = 'Citation de Gandhi',
        card_type = 'Citation'
        ");
$service_id = $pdo -> lastInsertId();
$services[] = $pdo -> lastInsertId();    
$pdo->exec("
    INSERT INTO cardElement SET 
        content='Prends soin de ton corps pour que ton âme ait envie d\'y rester', 
        order_nb=0,
        service_id = {$service_id}
        ");      

$pdo->exec("
    INSERT INTO service SET 
        name='Shiatsu sur chaise', 
        slug='shiatsu-chaise',
        summary='Technique de relaxation, à la fois relaxante et énergisante, où le receveur est habillé, en position assise sur une chaise ergonomique.',
        picture_id = 6,
        order_nb = 10,
        card_title = 'Tarifs',
        card_type = 'Tarif'
        ");
$services[] = $pdo -> lastInsertId(); 

$pdo->exec("
    INSERT INTO service SET 
        name='Massage californien', 
        slug='californien',
        summary='Massage aux huiles visant à la détente par de longs mouvements doux et fluides.',
        picture_id = 2,
        order_nb=20,
        card_title = 'Tarifs',
        card_type = 'Tarif'
        ");
$services[] = $pdo -> lastInsertId();  

$pdo->exec("
    INSERT INTO service SET 
        name='Massage des 5 continents', 
        slug='massage-5-continents',
        summary='Massage aux huiles combinant plusieurs techniques de massages issus des 5 continents.',
        picture_id = 1,
        order_nb=30,
        card_title = 'Tarifs',
        card_type = 'Tarif'
        ");
$services[] = $pdo -> lastInsertId();  

$pdo->exec("
    INSERT INTO service SET 
        name='Massage en entreprise', 
        slug='en-entreprise',
        summary='Shiatsu sur chaise pratiqué en entreprise, pour un maximum de détente en un minimum de temps.',
        picture_id = 3,
        order_nb=40,
        card_title = 'La pratique',
        card_type = 'Divers'
        ");
$service_id = $pdo -> lastInsertId();
$services[] = $pdo -> lastInsertId();  
for ($i=1; $i<=3; $i++) {
    $pdo->exec("INSERT INTO cardElement SET 
                    content = '{$faker->sentence(rand(5,7))}',
                    order_nb = {$i},
                    service_id = {$service_id}
                    ");
}     


$pdo->exec("
    INSERT INTO service SET 
        name='Autre événementiel', 
        slug='autre-evenementiel',
        summary='Massages (généralement shiatsu sur chaise) proposés lors de divers évênements (salon, mariage, camping,...).',
        picture_id = 4,
        order_nb=50,
        card_title = '',
        card_type = ''
        ");
$services[] = $pdo -> lastInsertId();  

foreach ($services as $service) {
    for ($i=1; $i<=3; $i++) {
        $pdo->exec("INSERT INTO paragraph SET 
                        name='{$faker->name()}', 
                        content = '{$faker->paragraphs(rand(1,4), true)}',
                        order_nb = {$i},
                        service_id = {$service}
                        ");
    }
}


//Remplissage des menus

$pdo->exec("
    INSERT INTO menu SET 
        name='Accueil', 
        root='home',
        slug='',
        level = 1,
        order_nb=10
        ");
$pdo->exec("
    INSERT INTO menu SET 
        name='Qui suis je ?',
        root='service', 
        slug='qui-suis-je',
        level = 1,
        order_nb=20,
        service_id = 1
        ");
$pdo->exec("
    INSERT INTO menu SET 
        name='Particuliers', 
        level = 1,
        order_nb=30
        ");
$pdo->exec("
    INSERT INTO menu SET 
        name='Evénementiel', 
        level = 1,
        order_nb=40
        ");
$pdo->exec("
    INSERT INTO menu SET 
        name='Tarifs', 
        root='price',
        slug='tarifs',
        level = 1,
        order_nb=50
        ");
$pdo->exec("
    INSERT INTO menu SET 
        name='Contact', 
        root='contact',
        slug='contact',
        level = 1,
        order_nb=60
        ");
$pdo->exec("
    INSERT INTO menu SET 
        name='Shiatsu sur chaise', 
        root='service',
        level = 2,
        order_nb=10,
        service_id = 2,
        parent_menu_id = 3
        ");
$pdo->exec("
    INSERT INTO menu SET 
        name='Massage californien', 
        root='service', 
        level = 2,
        order_nb=20,
        service_id = 3,
        parent_menu_id = 3
        ");
$pdo->exec("
    INSERT INTO menu SET 
        name='Massage des 5 continents', 
        root='service', 
        level = 2,
        order_nb=30,
        service_id = 4,
        parent_menu_id = 3
        ");
$pdo->exec("
    INSERT INTO menu SET 
        name='Massage en entreprise', 
        root='service', 
        level = 2,
        order_nb=10,
        service_id = 5,
        parent_menu_id = 4
        ");
$pdo->exec("
    INSERT INTO menu SET 
        name='Autre événementiel',  
        root='service',
        level = 2,
        order_nb=20,
        service_id = 6,
        parent_menu_id = 4
        ");

// Remplissage créneaux
for ($i=1; $i<=5; $i++) {
    $pdo->exec("INSERT INTO slot (day, start_time, end_time) VALUES ($i, '09:00:00', '12:00:00')");
    $pdo->exec("INSERT INTO slot (day, start_time, end_time) VALUES ($i, '14:00:00', '18:00:00')");
}


// Remplissage des tarifs

$pdo->exec("INSERT INTO priceCategory (name, order_nb) VALUES ('Particuliers', 10)");
$pdo->exec("INSERT INTO priceCategory (name, order_nb) VALUES ('Tarifs réduits', 20)");
$pdo->exec("INSERT INTO priceCategory (name, order_nb) VALUES ('Evénementiel', 30)");
$pdo->exec("INSERT INTO priceCategory (name, order_nb) VALUES ('Déplacement', 40)");

$pdo->exec("INSERT INTO priceType SET name = '€' ");
$pdo->exec("INSERT INTO priceType SET name = '%' ");

$pdo->exec("
    INSERT INTO price SET 
        priceCategory_id=1,
        name='Massage californien',
        text='1h',
        price = 50,
        priceType_id = 1
        ");
$pdo->exec("
    INSERT INTO price SET 
        priceCategory_id=1,
        name='Massage californien',
        text='1h30',
        price = 70,
        priceType_id = 1
        ");
$pdo->exec("
    INSERT INTO price SET 
        priceCategory_id=1,
        name='Shiatsu sur chaise',
        text='30 min',
        price = 30,
        priceType_id = 1
        ");
$pdo->exec("
    INSERT INTO price SET 
        priceCategory_id=1,
        name='Shiatsu sur chaise',
        text='45 min',
        price = 45,
        priceType_id = 1
        ");
$pdo->exec("
    INSERT INTO price SET 
        priceCategory_id=2,
        name='1er RDV (sur demande)',
        text='',
        price = -20,
        priceType_id = 2
        ");
$pdo->exec("
    INSERT INTO price SET 
        priceCategory_id=2,
        name='5ème séance',
        text='',
        price = -20,
        priceType_id = 2
        ");
$pdo->exec("
    INSERT INTO price SET 
        priceCategory_id=3,
        name='Shiatsu sur chaise',
        text='12/15 min',
        price = 10,
        priceType_id = 1
        ");
$pdo->exec("
    INSERT INTO price SET 
        priceCategory_id=3,
        name='Shiatsu sur chaise',
        text='25/30 min',
        price = 20,
        priceType_id = 1
        ");
$pdo->exec("
    INSERT INTO price SET 
        priceCategory_id=3,
        name='En entreprise',
        text='Sur devis'
        ");
$pdo->exec("
    INSERT INTO price SET 
        priceCategory_id=4,
        name='Sur Ligné',
        text='',
        price = 0,
        priceType_id = 1
        ");
$pdo->exec("
    INSERT INTO price SET 
        priceCategory_id=4,
        name='Par tranche de',
        text='5km',
        price = 2,
        priceType_id = 1
        ");


// Remplissage des évenements
for ($i=1; $i<=3; $i++) {
    $pdo->exec("INSERT INTO event SET 
                    name='{$faker->name()}',
                    date = '{$faker->date('d/m/Y')}', 
                    place = '{$faker->departmentName()}',
                    fb_url = 'https://www.facebook.com/events/283385240174592/?acontext=%7B%22event_action_history%22%3A[%7B%22mechanism%22%3A%22discovery_top_tab%22%2C%22surface%22%3A%22bookmark%22%7D]%7D',
                    picture = '',
                    order_nb = {$i}-1
                    ");
}

// Remplissage autres tables
$password= password_hash('admin', PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO user SET 
                    username='admin', 
                    password='$password'");


/* $posts = [];
$categories = [];

for ($i=0; $i<50; $i++) {
    $pdo->exec("INSERT INTO post SET 
                    name='{$faker->sentence()}', 
                    slug='{$faker->slug()}',
                    created_at='{$faker->date()} {$faker->time()}',
                    content = '{$faker->paragraphs(rand(3,15), true)}'");
    $posts[] = $pdo -> lastInsertId();
}

for ($i=0; $i<5; $i++) {
    $pdo->exec("INSERT INTO category SET 
                    name='{$faker->sentence(3)}', 
                    slug='{$faker->slug(3)}'");
    $categories[] = $pdo -> lastInsertId();
}

foreach ($posts as $post) {
    $randomCategories = $faker->randomElements($categories, rand(0, count($categories)));  //Retourne un tableau d'id de catégorie
    foreach ($randomCategories as $category) {
        $pdo->exec("INSERT INTO post_category SET 
                    post_id=$post, 
                    category_id=$category");
    }
}

$password= password_hash('admin', PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO user SET 
                    username='admin', 
                    password='$password'");
 */