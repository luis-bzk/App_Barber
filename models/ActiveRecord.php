<?php

namespace Model;

class ActiveRecord {

    // DATA base
    protected static $db;
    protected static $table = '';
    protected static $columnsDB = [];
    // messages and alerts
    protected static $alerts = [];
    
    // Define DB connection - includes/database.php
    public static function setDB($database) 
    {
        self::$db = $database;
    }

    public static function setAlert($type, $message)
    {
        static::$alerts[$type][] = $message;
    }

    // validation
    public static function getAlerts()
    {
        return static::$alerts;
    }

    public function validationAlerts()
    {
        static::$alerts = [];
        return static::$alerts;
    }

    // query the database for create a new object in memory
    public static function consultSQL($query)
    {
        // query database
        $result = self::$db->query($query);

        // Iterate the results
        $array = [];
        while($record = $result->fetch_assoc()) {
            $array[] = static::createObject($record);
        }

        // set free the memory
        $result->free();

        // return results
        return $array;
    }

    // Create an object that is equals to the DB
    protected static function createObject($record)
    {
        $object = new static;

        foreach($record as $key => $value ) {
            if(property_exists( $object, $key  )) {
                $object->$key = $value;
            }
        }

        return $object;
    }

    // Identify and match the attributes of the database
    public function attributes()
    {
        $attributes = [];
        foreach(static::$columnsDB as $column) {
            if($column === 'id') {
                continue;
            }
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    // Sanitize the data before saves on the DB
    public function sanitizeAttributes()
    {
        $attributes = $this->attributes();
        $sanitized = [];
        foreach($attributes as $key => $value ) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    // Synchronize Db with memory objects,
    // used for save data in the browser.. (like data in forms after POST)
    public function synchronize($args=[])
    {
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Records - CRUD
    public function save()
    {
        $result = '';
        if(!is_null($this->id)) {
            // update
            $result = $this->update();
        } else {
            // Creando un nuevo registro
            $result = $this->create();
        }
        return $result;
    }

    // All records
    public static function all()
    {
        $query = "SELECT * FROM " . static::$table;
        return self::consultSQL($query);
    }

    // search record by ID
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$table  ." WHERE id = ${id}";
        $result = self::consultSQL($query);
        return array_shift( $result );
    }

    // search a record by a value on a specific column
    public static function where($column, $value)
    {
        $query = "SELECT * FROM " . static::$table  ." WHERE ${column} = '${value}'";
        $result = self::consultSQL($query);
        return array_shift( $result );
        // aray shift return only first value
    }

    // search static SQL query, use when the method models are insuficient.
    public static function onSQL($query)
    {
        $result = self::consultSQL($query);
        return $result;
    }

    // Obtain record by amount
    public static function get($limit)
    {
        $query = "SELECT * FROM " . static::$table . " LIMIT ${limit}";
        $result = self::consultSQL($query);
        return array_shift( $result ) ;
    }

    // crea un nuevo registro
    public function create()
    {
        // Sanitize data
        $attributes = $this->sanitizeAttributes();

        // Insert on database
        $query = " INSERT INTO " . static::$table . " ( ";
        $query .= implode(', ', array_keys($attributes));
        $query .= " ) VALUES (' "; 
        $query .= implode("', '", array_values($attributes));
        $query .= " ') ";
        
        // debug a when trycatch in enabled
        // return json_encode(['query' => $query]);
        // return debugFetch('query', $query);

        // query result
        $result = self::$db->query($query);
        return [
           'result' =>  $result,
           'id' => self::$db->insert_id
        ];
    }

    // Update record
    public function update()
    {
        // Sanitize data
        $attributes = $this->sanitizeAttributes();

        // Iterate to add each field of the DB
        $values = [];
        foreach($attributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        // Consult SQL
        $query = "UPDATE " . static::$table ." SET ";
        $query .=  implode(', ', $values );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        // Update DB
        return self::$db->query($query);
    }

    // Delete record by ID
    public function delete()
    {
        $query = "DELETE FROM "  . static::$table . " WHERE id = " .
            self::$db->escape_string($this->id) . " LIMIT 1";
            return self::$db->query($query);
    }

}