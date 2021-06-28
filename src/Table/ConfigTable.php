<?php

namespace App\Table;

use App\Model\Config;
use App\Table\Exception\UndeleteException;
use PDO;

final class ConfigTable extends Table {

    protected $table = "config";
    protected $class = Config::class;

    public function findDistinctTable() 
    {
        $query = $this->pdo->query("SELECT distinct name FROM {$this->table} 
                                    ORDER BY name");
        return $query->fetchAll(PDO::FETCH_CLASS, $this->class);
    }

    public function findAllOfTable(string $table) 
    {
        $query = $this->pdo->query("SELECT c.* FROM {$this->table} c
                                     WHERE name = '{$table}' ORDER BY code");
        return $query->fetchAll(PDO::FETCH_CLASS, $this->class);
    }

    /**
     * Vérifie si une valeur existe dans la table correspondante
     *
     * @param  string $table table sur laquelle porte la recherche
     * @param  string $field Champs à rechercher
     * @param  mixed  $value Valeur associée au champs
     * @param  int    $id de l'enregistrement courant
     * @return bool
     */
    public function existsFieldTable(string $table, string $field, $value, ?int $except = null): bool 
    {
        $sql = "SELECT COUNT(id)  FROM {$this->table} WHERE name = ? and $field = ?";
        $params = [$table, $value];
        return $this->existsCompleteAndControl($sql, $params, $except);
    }

    
    public function updateConfig(Config $config): void
    {
        $this->update([
            'id' => $config->getId(),
            'name' => $config->getName(),
            'code' => $config->getCode(),
            'value' => $config->getValue()
    ],  $config->getId());

    }

    public function insertConfig(Config $config): void
    {
        $id = $this->insert([
            'name' => $config->getName(),
            'code' => $config->getCode(),
            'value' => $config->getValue()
            ]);
        $config->setId($id);    

    }

    public function deleteTable(string $table): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE name = ?");
        $result = $query->execute([$table]);
        if ($result === false) {
            throw new UndeleteException($this->table, $table);
        }
    }


}