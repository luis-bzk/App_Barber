<?php

namespace Controllers;

use Model\Appointment;
use Model\AppointmentAdmin;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        // session_start();
        isAdmin();
        $name = $_SESSION['name'];

        $date = $_GET['date'] ?? date('Y-m-d');
        $dateSel = explode('-', $date);
        $verifyDate = checkdate($dateSel[1], $dateSel[2], $dateSel[0]);
        if (!$verifyDate) {
            header('Location: /admin');
        }


        // copnsult database

        $query = "SELECT appooinments.id,  appooinments.hour, CONCAT(users.name, ' ', users.lastname) as customer, ";
        $query .= " users.email, users.phone, services.name as service, services.price ";
        $query .= " FROM appooinments ";
        $query .= " LEFT OUTER JOIN  users ";
        $query .= " ON appooinments.userId=users.id ";
        $query .= " LEFT OUTER JOIN  appoinmentsServices ";
        $query .= " ON  appoinmentsServices.appoinmentId = appooinments.id ";
        $query .= " LEFT OUTER JOIN services ";
        $query .= " ON services.id = appoinmentsServices.servicesId ";
        $query .= " WHERE date = '${date}'";

        $appointments = AppointmentAdmin::onSQL($query);

        $router->render("admin/index", [
            'name' => $name,
            'appointments' => $appointments,
            'date' => $date
        ]);
    }
}
