<?php

namespace Controllers;


use MVC\Router;

class AppointmentController
{
    public static function index(Router $router)
    {

        // notSession();

        isAuth();

        $name = $_SESSION['name'];
        $id = $_SESSION['id'];

        $router->render("appointment/index", [
            'name' => $name,
            'id' => $id
        ]);
    }
}
