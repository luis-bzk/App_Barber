<?php

namespace Controllers;

use Model\Service;
use MVC\Router;

class ServiceController 
{
    // view all the services
    public static function index(Router $router)
    {
        isAdmin();
        $name = $_SESSION['name'];

        $services = Service::all();

        $router->render('services/index', 
        [
            'name' => $name,
            'services' => $services
        ]);
    }

    // create a new service
    public static function create(Router $router)
    {
        isAdmin();
        $name = $_SESSION['name'];

        $service = new Service;
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $service->synchronize($_POST);

            $alerts = $service->validate();
            if(empty($alerts)){
                $service->save();
                header("Location: /services");
            }

        }

        $router->render('services/create', 
        [
            'name' => $name,
            'service' => $service,
            'alerts' => $alerts
        ]);
    }

    //update an existing service
    public static function update(Router $router)
    {
        isAdmin();
        $name = $_SESSION['name'];
        $alerts = [];
        $id = ($_GET['id']);
        
        // id is num verification
        $idNum = is_numeric($id);
        if(!$idNum) header('Location: /services'); 
        
        // id set the value
        $service = Service::find($id);
        if(!$service) header('Location: /services'); 

        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $service->synchronize($_POST);
            $alerts = $service->validate();

            if(empty($alerts)){
                $service->save();
                header('Location: /services');
            }
        }
        
        $router->render('services/update', 
        [
            'name' => $name,
            'alerts' => $alerts,
            'service' => $service
        ]);
    }

    // delete an existing service
    public static function delete()
    {
        isAdmin();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // id is num verification
            $id = $_POST["id"];

            $idNum = is_numeric($id);
            if(!$idNum) header('Location: /services'); 

            $service = Service::find($id);
            if(!$service) header('Location: /services'); 
            
            $service->delete();
            header('Location: /services');
        }
    }
}
