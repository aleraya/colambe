<?php

namespace App\Table\Exception;

use Exception;

class NotUpdateException extends Exception {

    public function __construct(string $table, int $key)
    {
        $this->message = "Impossible de mettre à jour l'enregistrement $key dans la table '$table'";
    }
}