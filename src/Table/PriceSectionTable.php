<?php

namespace App\Table;

use App\Model\PriceSection;
use PDO;

final class PriceSectionTable extends Table {

    protected $table = "pricesection";
    protected $class = PriceSection::class;

    public function findAll() 
    {
        $query = $this->pdo->query("SELECT e.* FROM {$this->table} e
                                    ORDER BY order_nb");
        return $query->fetchAll(PDO::FETCH_CLASS, $this->class);
    }

    public function updatePriceSection(PriceSection $pricesection): void
    {
        $this->update([
            'id' => $pricesection->getId(),
            'name' => $pricesection->getName(),
            'order_nb' => $pricesection->getOrderNb()
        ],  $pricesection->getId());
    }

    public function insertPriceSection(PriceSection $pricesection): void
    {
        $id = $this->insert([
            'name' => $pricesection->getName(),
            'order_nb' => $pricesection->getOrderNb()
            ]);
        $pricesection->setId($id);    

    }

}