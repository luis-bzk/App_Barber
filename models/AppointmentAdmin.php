<?php

namespace Model;

class AppointmentAdmin extends ActiveRecord{
    protected static $table = 'appoinmentsServices';
    protected static $columnsDB = ['id', 'hour', 'customer', 'email', 'phone', 'service', 'price'];
    public $id;
    public $hour;
    public $customer;
    public $email;
    public $phone;
    public $service;
    public $price;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->hour = $args['hour'] ?? '';
        $this->customer = $args['customer'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->service = $args['service'] ?? '';
        $this->price = $args['price'] ?? '';

    }

}