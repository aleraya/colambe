<?php

namespace App\Table;

use App\Model\Slot;
use DateTime;
use PDO;

final class SlotTable extends Table{

    protected $table = "Slot";
    protected $class = Slot::class;

    public function allOrderByTime()    
    {
        $day = DAY;
        $sql = "SELECT s.*, c.value as dayname FROM {$this->table} s
             LEFT JOIN config c on c.name = '{$day}' and s.day = c.code 
                 ORDER BY s.day, s.start_time";
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
    }

    public function isOverlap(string $day, DateTime $start_time, DateTime $end_time, ?int $id=null): bool 
    {
        $slots = $this->allOfDay($day, $id);
        foreach ($slots as $slot) {
            $start_timeDB = $slot->getStartTimeToDateTime();
            $end_timeDB = $slot->getEndTimeToDateTime();
            if ( ($start_time >= $start_timeDB && $start_time <= $end_timeDB) ||
                 ($end_time >= $start_timeDB && $end_time <= $end_timeDB) ||
                 ($start_time < $start_timeDB && $end_time > $end_timeDB)) {
                     return true;
                 }
        }
        return false;
    }

    private function allOfDay(string $day, ?int $id = null)
    {
        if ($id) {
            $query = $this->pdo->prepare("SELECT * FROM {$this->table}  WHERE day = :day AND id != :id");
            $query->execute(['day'=>$day, 'id'=>$id]);
        } else {
            $query = $this->pdo->prepare("SELECT * FROM {$this->table}  WHERE day = ?");
            $query->execute([$day]);
        }
        return $query->fetchAll(PDO::FETCH_CLASS, $this->class);

    }

    public function updateSlot(Slot $slot): void
    {
        $this->update([
            'id' => $slot->getId(),
            'day' => $slot->getDay(),
            'start_time' => $slot->getStartTime(),
            'end_time' => $slot->getEndTime()
        ],  $slot->getId());
    }

    public function insertSlot(Slot $slot): void
    {
        $id = $this->insert([
            'id' => $slot->getId(),
            'day' => $slot->getDay(),
            'start_time' => $slot->getStartTime(),
            'end_time' => $slot->getEndTime()
            ]);
        $slot->setId($id);    
    }
}