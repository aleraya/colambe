<?php

namespace App\Validators;

use App\Table\ConfigTable;

class ConfigValidator extends AbstractValidator {

    public function __construct (array $data, ConfigTable $table, bool $createNewTable, ?int $configId=null) 
    {
        parent::__construct($data);
        $this->validator->labels(array(
            'name' => 'La table',
            'code' => 'Le code',
            'value' => 'La valeur'
        ));
        $this->validator->rule('required', ['name', 'code', 'value']);
        $this->validator->rule('lengthMin', ['name'], 2);
        if ($createNewTable) {
            $this->validator->rule(function ($field, $value) use ($table, $configId, $data) {
                return !$table->exists($field, $value);
            }, 'name', 'existe déjà'); 
        }
        $this->validator->rule(function ($field, $value) use ($table, $configId, $data) {
            return !$table->existsFieldTable($data['name'], $field, $value, $configId);
        }, 'code', 'existe déjà'); 
    }
}