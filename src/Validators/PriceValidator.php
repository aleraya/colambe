<?php

namespace App\Validators;

use App\Table\PriceTable;

class PriceValidator extends AbstractValidator {

    public function __construct (array $data, PriceTable $table, ?int $priceId=null) 
    {
        parent::__construct($data);
        $this->validator->labels(array(
            'pricesection_id' => 'La rubrique',
            'name' => 'Le descriptif',
            'text' => 'Le complément',
            'price'=> 'Le tarif',
            'pricetype_id' => 'Le type de tarif'
        ));
        $this->validator->rule('required', ['pricesection_id', 'name']);
        $this->validator->rule('lengthMin', ['name'], 3);
        if ($data['price'] != '') {
            $this->validator->rule('integer', 'price');
        }
        /*$this->validator->rule(function ($field, $value) use ($table, $priceId) {
            return !$table->exists($field, $value, $priceId);
        }, 'name', 'existe déjà'); */
    }

}