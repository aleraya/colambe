<?php

namespace App\Table;

use App\Model\Price;
use PDO;

final class PriceTable extends Table {

    protected $table = "price";
    protected $class = Price::class;

    public function findAll() 
    {
        $pricetype = PRICETYPE;
        $query = $this->pdo->query("SELECT p.*, s.name as pricesection, c.value as pricetype
                                 FROM {$this->table} p
                                 LEFT JOIN pricesection s ON s.id = p.pricesection_id
                                 LEFT JOIN config c ON  c.name = '{$pricetype}' AND c.code = p.pricetype_id
                                    ORDER BY pricesection_id");
        return $query->fetchAll(PDO::FETCH_CLASS, $this->class);
    }

    public function updatePrice(Price $price): void
    {
        $this->update([
            'id' => $price->getId(),
            'name' => $price->getName(),
            'text' => $price->getText(),
            'price' => $price->getPrice(),
            'pricesection_id' => $price->getPricesectionId(),
            'pricetype_id' => $price->getPricetypeId()
        ],  $price->getId());
    }

    public function insertPrice(Price $price): void
    {
        $id = $this->insert([
            'name' => $price->getName(),
            'text' => $price->getText(),
            'price' => $price->getPrice(),
            'pricesection_id' => $price->getPricesectionId(),
            'pricetype_id' => $price->getPricetypeId()
            ]);
        $price->setId($id);    

    }

    public function findByPriceSection(int $id)
    {
        $pricetype = PRICETYPE;
        $query = $this->pdo -> prepare("
            SELECT p.*, c.value as pricetype FROM {$this->table} p 
            LEFT JOIN config c ON c.name = '{$pricetype}' AND c.code = p.priceType_id
            WHERE pricesection_id = :id ORDER BY name, price
            ");
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $prices = $query->fetchAll();
        $name = '';
        $count= 0;
        // Alimentation nombre d'occurence du nom
        foreach ($prices as $price) {
            if ($price->getName()!==$name) {
                $name = $price->getName();
                $sql = "SELECT COUNT(id) FROM {$this->table} 
                        WHERE pricesection_id = :id and name= :name";
                $query= $this->pdo->prepare($sql);
                $params = ['id' => $id,
                         'name' => $name];
                $query->execute($params);
                $count = (int)$query->fetch(PDO::FETCH_NUM)[0];
            }
            $price->setNbNameId($count);
        }
        return $prices;        
    }
}