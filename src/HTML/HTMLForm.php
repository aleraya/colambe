<?php

namespace App\HTML;

/**
 * Class HTMLForm
 * Permet de générer un formulaire rapidement et simplement.
 */
class HTMLForm {
    
    private $data;
    private $errors;
    private $isAdmin;  //En administrateur on affiche toutes les anomalies d'un coup
                       //Sinon on affiche la 1ère anomalie de chaque zone

    public function __construct($data, array $errors, bool $isAdmin=true)
    {
        $this->data = $data;
        $this->errors = $errors;
        $this->isAdmin = $isAdmin;
    }
    
    public function input(string $key, string $label, bool $required=false, string $attribute=''): string
    {
        $value = $this->getValue($key);

        $type = $key === 'password' ? 'password' : 'text';
        
        $sup = '';
        if ($required) {
            $sup = '<sup>*</sup>';
        }
        return <<<HTML
        <div>
            <label for="field{$key}">{$label} {$sup}</label>
            <input type="{$type}" id="field{$key}" name="{$key}" value="{$value}" {$attribute}>
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
            <textarea type="text" id="field{$key}" name="{$key}">{$value}</textarea>
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

    public function select(string $key, string $label, array $options=[], bool $required=false, ?string $multiple=''): string
    {
        $optionsHTML = [];
        $sup = '';
        if ($required) {
            $sup = '<sup>*</sup>';
        } else {
            $optionsHTML[]= "<option value=''></option>";
        }
        $value = $this->getValue($key);
        foreach ($options as $k => $v){
            if ($multiple) {
                $selected = in_array($k, $value) ? ' selected' : '';
            } else {
                $selected = $k === $value ? ' selected' : '';
            }
            $optionsHTML[]= "<option value=\"$k\"$selected>$v</option>";
        }   

        $optionsHTML = implode('', $optionsHTML);

        $name = $multiple ? $key."[]" : $key;
  
        return <<<HTML
            <div>
                <label for="field{$key}">{$label}{$sup}</label>
                <select type="text" id="field{$key}" name="{$name}" {$multiple}>{$optionsHTML}</select>
                {$this->getError($key)}
            </div>
        HTML;

    }

    private function getValue(string $key)
    {
        if (is_array($this->data)){             //tableau
            return $this->data[$key] ?? null;
        } else {                                //objet
            //$method = 'get'.ucfirst($key);
            $method = 'get'.str_replace(' ','', ucwords(str_replace('_', ' ', $key)));
            $value = $this->data->$method();
            if ($value instanceof \DateTimeInterface) {
                if (strpos($key, "time") === 0) {
                    return $value->format("Y-m-d H:i:s");
                } else {
                    return $value->format("H:i");
                }
            }
            if (strpos($key, "time") != 0 && strlen($value) > 5) {
                $value = substr($value, 0, 5);
            }
            return $value;
        }
    }

    private function getError(string $key): string
    {
        $error='';
        if (isset($this->errors[$key])) {
            if (is_array($this->errors[$key])) {
                if ($this->isAdmin) {
                    $error = implode('<br>', $this->errors[$key]);
                } else {
                    $error = $this->errors[$key][0];
                }
            } else {
                $error = $this->errors[$key];
            }
        }
        if ($error==='') {
            return '';
        } else {
            return '<div class="error">' . $error . '</div>';
        }
    }
}
