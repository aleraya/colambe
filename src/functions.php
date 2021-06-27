<?php

// Contient les fonctions que l'on peut avoir besoin globalement
// chargement définit au niveau de composer.json (sinon on aurait pu faire include dans public index)

/******* Pour echapper du text ********/
function e(string $string) 
{
    return htmlspecialchars($string);
}

/******* Pour supprimer extension d'un fichier ********/
function delExt ($file) {
    
    // cherche la postion du '.'  
    $position = strpos($file, ".");
    
    // enleve l'extention, tout ce qui se trouve apres le '.'
    return substr($file, 0, $position);
  }

/**
 * getHeure  Renvoie l'heure au format Gh si minutes à 0 et Hhi sinon
 *
 * @param  mixed $time
 * @return string
 */
function getHour(DateTime $time): string
{
    if ($time->format('i') === '00'){
        return $time->format('G').'h';
    } else {
        return $time->format('G').'h'.$time->format('i');
    }       
}