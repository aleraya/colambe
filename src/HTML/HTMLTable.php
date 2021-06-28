<?php

namespace App\HTML;

use App\Connection;
use App\Model\Config;
use App\Router;
use App\Table\ConfigTable;
use App\Table\SlotTable;
use PDO;

class HTMLTable {

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
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
                $phrase = getHour($slot->getStartTime()).'-'.getHour($slot->getEndTime()); 
            } else {
                $phrase .= ' '. getHour($slot->getStartTime()).'-'.getHour($slot->getEndTime()); 
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