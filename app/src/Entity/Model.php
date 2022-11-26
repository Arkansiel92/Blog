<?php

namespace App\Entity;

use App\Factory\PDOFactory;

class Model extends PDOFactory
{
    protected $table;

    private $database;

    public function querySQL(string $sql, array $attributs = []) {

        $this->database = PDOFactory::getMySqlPDO();

        if ($attributs != null) {
            $query = $this->database->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            return $this->database->query($sql);
        }
    }

    public function getAll()
    {
        $query = $this->querySQL('SELECT * FROM '. $this->table);
        return $query->fetchAll();
    }

    public function getBy(array $data)
    {
        $keys = [];
        $values = [];

        foreach($data as $key => $value) {
            $keys[] = "$key = ?";
            $values[] = "$value = ?";
        }

        $list_keys = implode(' AND ', $keys);
        $sql = 'SELECT * FROM '. $this->table . ' WHERE '. $list_keys;

        return $this->querySQL($sql, $values)->fetchAll();
    }

    public function getById(int $id)
    {
        $sql = "SELECT * FROM ". $this->table . " WHERE id = $id";

        return $this->querySQL($sql)->fetch();
    }

    public function create()
    {
        $keys = [];
        $inter = [];
        $values = [];
        
        foreach($this as $key => $value) {
            if ($value !== NULL && $key != 'database' && $key != 'table') {
                $keys[] = "$key";
                $inter[] = "?";
                $values[] = "$value";
            }

        }

        $list_keys = implode(', ', $keys);
        $list_inter = implode(', ', $inter);

        $sql = 'INSERT INTO '. $this->table .'('. $list_keys . ') VALUE ('. $list_inter .')';

        return $this->querySQL($sql, $values);
    }

    public function update()
    {
        $keys = [];
        $values = [];

        foreach($this as $key => $value) {
            if ($value !== NULL && $key != 'database' && $key != 'table') {
                $keys[] = "$key = ?";
                $values[] = "$value";
            }
        }
        $values[] = $this->id;

        $list_keys = implode(', ', $keys);

        $sql = 'UPDATE '. $this->table . ' SET '. $list_keys .' WHERE id = ?';

        return $this->querySQL($sql, $values);
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE id = ?';

        return $this->querySQL($sql, [$id]);
    }

    public function hydrate($data)
    {
        foreach($data as $key => $value) {
            $setter = 'set'. ucfirst($key);

            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
        return $this;
    }
}