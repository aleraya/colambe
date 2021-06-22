<?php

namespace App\Table\Exception;

use Exception;

class NotFoundException extends Exception {

    public function __construct(string $table, $key)
    {
        $this->message = "Aucun enregistrement ne correspond à l'élément $key dans la table '$table'";
    }
}