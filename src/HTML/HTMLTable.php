<?php

namespace App\HTML;

use App\Connection;
use App\Model\Config;
use App\Router;
use App\Table\ConfigTable;
use App\Table\PriceTable;
use App\Table\SlotTable;
use PDO;

class HTMLTable {

    private $pdo;
    private $pricesection_id;

    public function __construct(PDO $pdo, ?int $id=null )
    {
        $this->pdo = $pdo;
        $this->pricesection_id = $id;
    }

    public function displayTableSlot(): string 
    {
        $slots = (new SlotTable($this->pdo))->allOrderByTime();
        $slotshtml = $this->slots_html($slots);
        $html = '';
        $pdo = Connection::getPDO();
        $configTable = new ConfigTable($pdo);
        foreach ($slotshtml as $k=>$value) {
            $day = $configTable->findTableCode(DAY, $k)->getValue();
            $html .= '<tr>';
            $html .= $this->td($day, "contact-td");
            $html .= $this->td($value, "contact-td");
            $html .= '</tr>';
        }
        return $html;
    }

    public function displayTablePrice(): string 
    {
        $html='';
        
        $priceTable = new PriceTable($this->pdo);
        $prices = $priceTable->findByPriceSection($this->pricesection_id); 

        $name='';
        foreach ($prices as $price) {
            if ($price->getName() !== $name) {
                $name = $price->getName();
                $occnb = 0;
            }
            $occnb +=1;
            $html .= '<tr>';
            if ($occnb === 1) {
                $html .= $this->td($name, "trace", $price->getNbNameId());
            }
            $html .= $this->td($price->getText(), "trace");
            $p='';
            if ($price->getPrice()!== null) {
                if ($price->getPrice()===0) {
                    $p = 'Offert';
                } else {
                    $p = $price->getPrice(). ' '.$price->getPricetype();
                }
            }
            $html .= $this->td($p, "trace");
            $html .= '</tr>';
        }
        return $html;
    }

    public function slots_html(array $slots): array
    {
        $phrases=[
            '1' => 'Fermé',
            '2' => 'Fermé',
            '3' => 'Fermé',
            '4' => 'Fermé',
            '5' => 'Fermé',
            '6' => 'Fermé',
            '7' => 'Fermé',
        ];
        $day = 0;
        $phrase = 'Fermé';
        foreach($slots as $slot) {
            if ($day !== $slot->getDay()) {
                if ($day !== 0) {
                    $phrases[$day] = trim($phrase);
                }
                $day = $slot->getDay();
                $phrase = getHour($slot->getStartTimeToDateTime()).'-'.getHour($slot->getEndTimeToDateTime()); 
            } else {
                $phrase .= ' '. getHour($slot->getStartTimeToDateTime()).'-'.getHour($slot->getEndTimeToDateTime()); 
            }
        }
        if ($day !== 0) {
            $phrases[$day] = trim($phrase);
        }
        return $phrases;
    }

    public function td(string $text, string $class="", int $rowspan=1)
    {
        if ($rowspan === 1) {
            return <<<HTML
                <td class="$class">{$text}</td>
            HTML;
        } else {    
            return <<<HTML
                <td class="$class" rowspan="$rowspan">{$text}</td>
            HTML;
        }
    }

}