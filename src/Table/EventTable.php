<?php

namespace App\Table;

use App\Model\Event;
use PDO;

final class EventTable extends Table {

    protected $table = "event";
    protected $class = Event::class;

    public function findAll() 
    {
        $query = $this->pdo->query('SELECT e.*, p.url, p.description FROM event e
                      LEFT JOIN picture p ON e.picture_id = p.id
                      WHERE order_nb <> 0 ORDER BY order_nb');
        return $query->fetchAll(PDO::FETCH_CLASS, Event::class);
    }
    
}