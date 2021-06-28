<?php

namespace App\Table\Exception;

use Exception;

class UndeleteException extends Exception {

    public function __construct(string $table, int $key)
    {
        $this->message = "Impossible de supprimer l'enregistrement $key dans la table '$table'";
    }
}