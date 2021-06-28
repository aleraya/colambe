<?php

namespace App\Table;

use App\Table\Exception\NotFoundException;
use App\Table\Exception\NotInsertException;
use App\Table\Exception\NotUpdateException;
use App\Table\Exception\UndeleteException;
use Exception;
use PDO;

abstract class Table {

    protected $pdo;
    protected $table = null;
    protected $class = null;

    public function __construct(PDO $pdo)
    {
        if($this->table === null) {
            throw new Exception("La classe " . get_class($this) . " n'a pas de propriété \$table");
        }
        if($this->class === null) {
            throw new Exception("La classe " . get_class($this) . " n'a pas de propriété \$class");
        }
        $this->pdo = $pdo;
    }
    
    public function find(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();
        if($result === false) {
            throw new NotFoundException($this->table, $id);
        }
        return $result;
    }
    
    /**
     * Vérifie si une valeur existe dans la table
     *
     * @param  string $field Champs à rechercher
     * @param  mixed  $value Valeur associée au champs
     * @param  int    $id de l'enregistrement courant
     * @return bool
     */
    public function exists(string $field, $value, ?int $except = null): bool 
    {
        $sql = "SELECT COUNT(id)  FROM {$this->table} WHERE $field = ?";
        $params = [$value];
        return $this->existsCompleteAndControl($sql, $params, $except);
    }

    public function existsCompleteAndControl(string $sql, array $params=[], ?int $except=null): bool 
    {
        if ($except !== null) {
            $sql .= " and id != ?";
            $params[] = $except;
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return (int) $query->fetch(PDO::FETCH_NUM)[0] > 0;
    }

    public function all(): array {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
    }

    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $result = $query->execute([$id]);
        if ($result === false) {
            throw new UndeleteException($this->table, $id);
        }
    }

    public function insert(array $data): int 
    {
        $sqlFields = [];  //Attention, par le dynamique risque d'injections plus élevées.
        foreach($data as $key=>$value) {
            $sqlFields[] = "$key =:$key";
        }
        $query = $this->pdo -> prepare(
            "INSERT INTO {$this->table} 
                SET ". implode(', ', $sqlFields));

        $result = $query->execute($data);
        
        if ($result === false) {
            throw new NotInsertException($this->table);
        }   
        return (int)$this->pdo->lastInsertId();     

    }

    public function update(array $data, int $id)
    {
        $sqlFields = [];  
        foreach($data as $key=>$value) {
            $sqlFields[] = "$key =:$key";
        }
        $query = $this->pdo -> prepare(
            "UPDATE {$this->table} 
                SET ". implode(', ', $sqlFields).
              " WHERE id = :id  ");

        $result = $query->execute(array_merge($data, ['id'=>$id]));
        
        if ($result === false) {
            throw new NotUpdateException($this->table, $id);
        }   
 
    }

    public function queryAndFectchAll(string $sql): array
    {
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
    }

}