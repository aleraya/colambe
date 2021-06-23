<?php

namespace App\Table;

use App\Model\Event;
use Exception;
use PDO;

final class EventTable extends Table {

    protected $table = "event";
    protected $class = Event::class;

    public function findAll() 
    {
        $query = $this->pdo->query("SELECT e.* FROM {$this->table} e
                                    ORDER BY order_nb");
        return $query->fetchAll(PDO::FETCH_CLASS, Event::class);
    }

    public function findAllDisplay() 
    {
        $query = $this->pdo->query("SELECT e.* FROM {$this->table} e
                                     WHERE order_nb <> 0 ORDER BY order_nb");
        return $query->fetchAll(PDO::FETCH_CLASS, Event::class);
    }
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $ok = $query->execute([$id]);
        if ($ok === false) {
            throw new Exception("Suppression impossible de l'enregistrement $id de la table {$this->table}");
        }
    }

    public function update(Event $event): void
    {
        $query = $this->pdo->prepare("UPDATE {$this->table} 
                                        SET name = :name, date = :date, place = :place, fb_url = :fb_url, picture = :picture, order_nb = :order_nb 
                                        WHERE id = :id");
        $ok = $query->execute([
            'id' => $event->getId(),
            'name' => $event->getName(),
            'date' => $event->getDate(),
            'place' => $event->getPlace(),
            'fb_url' => $event->getFbUrl(),
            'picture' => $event->getPicture(),
            'order_nb' => $event->getOrderNb()
        ]);
        if ($ok === false) {
            throw new Exception("Mise à jour impossible de l'enregistrement {$event->getId()} de la table {$this->table}");
        }
    }

    public function create(Event $event): void
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} 
                                        SET name = :name, date = :date, place = :place, fb_url = :fb_url, picture = :picture, order_nb = :order_nb ");
        $ok = $query->execute([
            'name' => $event->getName(),
            'date' => $event->getDate(),
            'place' => $event->getPlace(),
            'fb_url' => $event->getFbUrl(),
            'picture' => $event->getPicture(),
            'order_nb' => $event->getOrderNb()
        ]);
        if ($ok === false) {
            throw new Exception("Création impossible de l'enregistrement dans la table {$this->table}");
        }
        $event->setId($this->pdo->lastInsertId());
    }

}