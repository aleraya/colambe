<?php

namespace App\HTML;

class Form {

    private $data;
    private $errors;

    public function __construct($data, array $errors)
    {
        $this->data = $data;
        $this->errors = $errors;
    }
    
    public function input(string $key, string $label, bool $required=false): string
    {
        $value = $this->getValue($key);
        
        $sup = '';
        if ($required) {
            $sup = '<sup>*</sup>';
        }
        return <<<HTML
        <div>
            <label for="field{$key}">{$label} {$sup}</label>
            <input type="text" id="field{$key}" name="{$key}" value="{$value}">
            {$this->getError($key)}
        </div>
        HTML;

    }
    public function textarea(string $key, string $label, bool $required=false): string
    {
        $value = $this->getValue($key);
        $sup = '';
        if ($required) {
            $sup = '<sup>*</sup>';
        }
        return <<<HTML
        <div>
            <label for="field{$key}">{$label} {$sup}</label>
            <textarea type="text" id="field{$key}" name="{$key}"> {$value} </textarea>
            {$this->getError($key)}
        </div>
        HTML;
    }
    
    /**
     * file
     *
     * @param  mixed $key        nom du champs du fichier à télécharger
     * @param  mixed $label      label du champs pour télécharger nouveau fichier
     * @param  mixed $required   true si champs obligatoire, false si facultatif
     * @param  mixed $keyOld     nom du champs de la table contenant l'image actuelle
     * @param  mixed $labelOld   label du champs contenant le nom actuel de l'image
     * @return void
     */
    public function file(string $key, string $label, bool $required=false, ?string $keyOld=null, ?string $labelOld=null)
    {
        $valueOld = $this->getValue($keyOld);

        $sup = '';
        $checkbox = '';
        if ($required) {
            $sup = '<sup>*</sup>';
        } elseif (isset($valueOld) && $valueOld !=='') {
            $checkbox = <<<HTML
            <input type="checkbox" id="delete" name="delete">
            <label for="delete">Supprimer l'image</label>
            HTML;
        }
        $inputOld = '';
        if ($keyOld && isset($valueOld) && $valueOld !=='') {
            $inputOld = <<<HTML
            <div>
                <label>{$labelOld}</label>
            </div>
            <div>
                <img src= "{$this->data->getThumb()}" alt="">
                <input class= "noDisplay" type="text" name="{$keyOld}" value= "{$valueOld}">
            </div>
            HTML;
        }
        return <<<HTML
        {$inputOld}
        {$checkbox}
        <div>
            <label for="field{$key}">{$label} {$sup}</label>
            <input type="file" id="field{$key}" name="{$key}">
            {$this->getError($key)}
        </div>
        HTML;
    }

    private function getValue(string $key): ?string
    {
        if (is_array($this->data)){             //tableau
            return $this->data[$key] ?? null;
        } else {                                //objet
            //$method = 'get'.ucfirst($key);
            $method = 'get'.str_replace(' ','', ucwords(str_replace('_', ' ', $key)));
            $value = $this->data->$method();
            if ($value instanceof \DateTimeInterface) {
                return $value->format("Y-m-d H:i:s");
            }
            return $value;
        }
    }

    private function getError(string $key): string
    {
        $error='';
        if (isset($this->errors[$key])) {
            $error = '<div class="error">' . implode('<br>', $this->errors[$key]) . '</div>';
        }
        return $error;
    }
}

