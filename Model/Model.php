<?php 

namespace Model;

use \PDO;

abstract class Model
{
    private $connection;
    private $model;
    private $select = '*';
    private $stmt;

    public function __construct(PDO $connection = null)
    {
        $this->connection = $connection;
        if ($this->connection === null) {
            $this->connection = new PDO(
                'mysql:host=' . config('host') . ';dbname=' . config('database'), 
                config('username'), 
                config('password')
            );

            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE, 
                PDO::ERRMODE_EXCEPTION
            );
        }

        $this->model = get_called_class();
    }

    public function find($id)
    {
        $stmt = $this->connection->prepare("
            SELECT * 
             FROM $this->table
             WHERE id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Set the fetchmode to populate an instance of 'Model'
        // This enables us to use the following:
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->model);
        return $stmt->fetch();
    }

    public function all()
    {
        $stmt = $this->connection->prepare("
            SELECT * FROM $this->table
        ");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->model);

        // fetchAll() will do the same as above, but we'll have an array. ie:
        return $stmt->fetchAll();
    }

    public function select($select)
    {
        $this->select = $select;
        return $this;
    }

    public function where($column, $operator, $value)
    {
        $this->stmt = $this->connection->prepare("
            SELECT $this->select
            FROM $this->table
            WHERE $column $operator :$column
        ");

        $this->stmt->bindParam(":$column", $value);

        return $this;
    }

    public function get()
    {
        $this->stmt->execute();
        $this->stmt->setFetchMode(PDO::FETCH_CLASS, $this->model);

        return $this->stmt->fetchAll();
    }

    public function create(array $data)
    {
        $columns = array_keys($data);

        if (isset($this->fillable)) {
            $columns = array_intersect($this->fillable, $columns);
        }

        $stmt = $this->connection->prepare("
            INSERT INTO $this->table
                (" . implode(',', $columns) . ")
            VALUES
                (:" . implode(', :', $columns) . ")
        ");

        foreach ($columns as $column) {
            $stmt->bindParam(':' . $column, $data[$column]);
        }

        $stmt->execute();

        return (int) $this->connection->lastInsertId();
    }

    public function update(array $data, $id)
    {
        $columns = array_keys($data);

        if (isset($this->fillable)) {
            $columns = array_intersect($this->fillable, $columns);
        }

        $set = '';

        foreach ($columns as $column) {
            $set .= "$column = :$column, ";
        }

        $set = rtrim($set, ', ');

        $stmt = $this->connection->prepare("
            UPDATE $this->table
            SET $set
            WHERE id = :id
        ");

        foreach ($columns as $column) {
            $stmt->bindParam(':' . $column, $data[$column]);
        }

        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->connection->prepare("
            DELETE
             FROM $this->table
             WHERE id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->execute();
    }
}
