<?php

namespace App\Validators;

use App\Table\PriceSectionTable;

class PriceSectionValidator extends AbstractValidator {

    public function __construct (array $data, PriceSectionTable $table, ?int $eventId=null) 
    {
        parent::__construct($data);
        $this->validator->labels(array(
            'name' => 'La rubrique du tarif',
            'order_nb' => 'Le n° d\'ordre'
        ));
        $this->validator->rule('required', ['name']);
        $this->validator->rule('lengthMin', ['name'], 3);
        $this->validator->rule('integer', 'order_nb');
        $this->validator->rule('min', 'order_nb', 0);
        /* $this->validator->rule(function ($field, $value) use ($table, $eventId) {
            return !$table->exists($field, $value, $eventId);
        }, 'name', 'existe déjà'); */
    }

}