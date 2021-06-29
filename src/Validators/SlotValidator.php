<?php

namespace App\Validators;

use App\Table\SlotTable;

class SlotValidator extends AbstractValidator {

    public function __construct (array $data, SlotTable $table, ?int $slotId=null) 
    {
        parent::__construct($data);
        $this->validator->labels(array(
            'day' => 'Le jour',
            'start_time' => 'L\'heure de début',
            'end_time' => 'L\'heure de fin'
        ));
        $this->validator->rule('required', ['day', 'start_time', 'end_time']);
        $this->validator->rule('dateFormat', ['start_time','end_time'] , 'H:i');
    }

}