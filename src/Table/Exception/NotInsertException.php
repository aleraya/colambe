<?php

namespace App\Table\Exception;

use Exception;

class NotInsertException extends Exception {

    public function __construct(string $table)
    {
        $this->message = "Impossible d'ajouter l'enregistrement dans la table '$table'";
    }
}