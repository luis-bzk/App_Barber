<?php
namespace Controllers;

use Model\Appointment;
use Model\AppointmentService;
use Model\Service;
use MVC\Router;

class APIController
{
    public static function index()
    {
        $services = Service::all();
        echo json_encode($services);
    }

    public static function save()
    {

        //save appointment in database and return an Id
        $appointment = new Appointment($_POST);
        $result = $appointment->save(); //save on result an array =[result, id]
        // return id from appointment in insertion in DB

        $id = $result['id'];

        // separate each id service with ','
        $idServices = explode(",", $_POST['services']);
        
        // save appointment and the services with id appointment
        foreach($idServices as $idService){
             $args = [
                 'appoinmentId' => intval($id),
                 'servicesId'=> intval($idService)
             ];
             $appointmentService = new AppointmentService($args);
             $appointmentService->save();
        }

        // return answer
        $answer = [
            'result' => $result
        ];

        echo json_encode($answer);
    }

    public static function Delete()
    {
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = intval($_POST['id']);

            $appointment = Appointment::find($id);
            
            $appointment->delete();

            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

}
