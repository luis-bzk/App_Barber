<?php
namespace Model;

class Service extends ActiveRecord
    {
    // Data Base
    protected static $table = 'services';
    protected static $columnsDB = ['id', 'name', 'price'];

    public $id;
    public $name;
    public $price;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->price = $args['price'] ?? '';
    }

    public function validate()
    {
        if(!$this->name){
            self::$alerts['error'][] = "Service name is required";
        }
        if(!$this->price){
            self::$alerts['error'][] = "Service price is required";
        }
        if(!is_numeric($this->price)){
            self::$alerts['error'][] = "The value of the price is unavailable";
        }
        return self::$alerts;
    }

}
