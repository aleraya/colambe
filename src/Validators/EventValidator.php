<?php

namespace App\Validators;

use App\Table\EventTable;

class EventValidator extends AbstractValidator {

    public function __construct (array $data, EventTable $table, ?int $eventId=null) 
    {
        parent::__construct($data);
        $this->validator->labels(array(
            'name' => 'L\'événement',
            'date' => 'La date',
            'place' => 'Le lieu'
        ));
        $this->validator->rule('required', ['name', 'date', 'place']);
        $this->validator->rule('lengthMin', ['name', 'date', 'place'], 3);
        $this->validator->rule(function ($field, $value) use ($table, $eventId) {
            return !$table->exists($field, $value, $eventId);
        }, 'name', 'existe déjà');
    }

}