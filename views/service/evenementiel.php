<?php

use App\Connection;
use App\Table\EventTable;

$title = "Evénementiel | Colambe";

$pdo = Connection::getPDO();

$table = new EventTable($pdo);
$events = $table->findAllDisplay();
?>

<article class='l-main__detail'>
    <h1 class='prestation-title'>Massage en événementiel</h1>
    <div class='prestation-detail'>
        <div class='prestation-detail__gauche'>
            <img class= "prestation-img" src="webroot/img/shiatsu3-403-403.png" alt="Shiatsu en événementiel" >
        </div>
        <div  class='prestation-detail__droite'>
            <section>
                <h2 class='prestation-subtitle'>Description</h2>
                <p>La pratique proposée en événementiel est le plus souvent le shiatsu sur chaise (ou amma), consistant à un enchainement de pressions manuelles sur des points d'accupression, percussions, étirements et balayages, pratiqué sur un receveur assis sur une chaise ergonomique.</p>
                <p>Je suis toutefois prête à étudier toute autre demande.</p>
                <p>Le massage peut être proposé dans le cadre de salons bien-être, de mariages ou autres évenements privés, ou sur un lieu de vacances ...</p> 
                <p>Pour connaitre les événements publics programmés, voir la rubrique ci-après ou consulter ma page facebook.</p>
            </section>
        </div>
    </div>
</article>
<article class='l-main__detail'>
    <h1 class='prestation-title'>Prochains événements</h1>
    <?php if (count($events) === 0): ?>
        <div class="prestation-card prestation-card--center txtcenter">
            <h3>Aucun événement prévu actuellement</h3>
        </div>
    <?php else: ?>
        <?php foreach ($events as $event): ?>
            <div class="prestation-card prestation-card--center txtcenter">
                <h3><?=htmlentities($event->getName()) ?></h3>
                <h4><?=htmlentities($event->getDate()) ?></h4>
                <address><?=htmlentities($event->getPlace()) ?></address>
                <?php if ($event->getFbUrl() !==''): ?>
                    <div class="logo-fb">
                        <a href="<?=htmlentities($event->getFbUrl())?>" target= '_blank'><img src="webroot/img/facebook.png" alt="Logo facebook" height="32" width="32"></a>                
                    </div>
                <?php endif; ?>
                <?php if (($event->getThumb())!==null): ?>
                    <img src="<?=$event->getThumb() ?>" alt="">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</article>

