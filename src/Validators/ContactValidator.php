<?php

namespace App\Validators;

class ContactValidator extends AbstractValidator {

    public function __construct (array $data) 
    {
        parent::__construct($data);
        $this->validator->labels(array(
            'name' => 'Le nom',
            'firstName' => 'Le prénom',
            'email' => 'L\'adresse mail',
            'tel' => 'Le téléphone',
            'message' => 'Le message'
        ));
        $this->validator->rule('required', ['name', 'firstName', 'email', 'tel', 'message']);
        $this->validator->rule('lengthBetween', ['name', 'firstName'], 2, 30);
        $this->validator->rule('email', 'email');
        //(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        $this->validator->rule('lengthMin', 'tel', 10);
        //(!preg_match("/^(0|\\+33)[1-9]([-. ]?[0-9]{2}){4}$/", $_POST['tel'] ))
        $this->validator->rule('regex', 'tel','/^(0|\\+33)[1-9]([-. ]?[0-9]{2}){4}$/');
        $this->validator->rule('lengthMin', 'message', 10);
    }

}