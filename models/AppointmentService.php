<?php
namespace Model;

class AppointmentService extends ActiveRecord{
    protected static $table = 'appoinmentsServices';
    protected static $columnsDB = ['id', 'appoinmentId', 'servicesId'];

    public $id;
    public $appoinmentId;
    public $servicesId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->appoinmentId = $args['appoinmentId'] ?? '';
        $this->servicesId = $args['servicesId'] ?? '';
    }
}