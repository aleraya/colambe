<?php

namespace App\Table;

use App\Model\Slot;
use PDO;

final class SlotTable extends Table{

    protected $table = "Slot";
    protected $class = Slot::class;

    public function allOrderByTime()    
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY day, start_time";
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
    }


}