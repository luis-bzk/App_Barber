<?php

namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class LoginController
{
    // login in the account
    public static function login(Router $router)
    {
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new User($_POST);
            $alerts = $auth->loginValidation();

            if(empty($alerts)){
                // check if user exists
                $user = User::where('email', $auth->email);

                if ($user){
                    //validate password
                    if($user->checkPasswordAndValidation($auth->password)){
                        // autenticate the user
                        session_start();
                        $_SESSION['id'] = $user->id;
                        $_SESSION['name'] = $user->name . ' ' . $user->lastname;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['login'] = true;

                        // redirection
                        if ($user->admin === '1'){
                            $_SESSION['admin'] = $user->admin ?? null;
                            header('Location: /admin');
                        }else{
                            header('Location: /appointment');
                        }

                    }
                }else{
                    User::setAlert('error', "user not found");
                }
            }
        }

        $alerts = User::getAlerts();
        // RENDER VIEW
        $router->render("auth/login", [
            'alerts' => $alerts
        ]);
    }

    public static function logout() // logout of an account
    {
        session_start();
        
        $_SESSION = [];

        header('Location: /');
    }

    /**
     * @throws \PHPMailer\PHPMailer\Exception
     */
    // create an account
    public static function createAccount(Router $router)
    {
        $user = new User;
        $alerts = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->synchronize($_POST);
            $alerts = $user->newAccountValidation();

            // alerts be empty
            if (empty($alerts)) {
                // user validation, if it is was not already registered
                $result = $user->userExists();
                if ($result->num_rows) {
                    $alerts = User::getAlerts();
                } else {
                    // hash password
                    $user->hashPassword();

                    // generate token
                    $user->generateToken();

                    //send email
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendConfirmation();

                    //create user
                    $result = $user->save();

                    if ($result) {
                        header('Location: /message');
                    }

                }

            }
        }

        // RENDER VIEW
        $router->render("auth/create-account", [
            'user' => $user,
            'alerts' => $alerts
        ]);
    }

    // forgot password and ask for a reset and send a token
    public static function forgotPassword(Router $router) //if forgot an account
    {
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new User($_POST);
            $alerts = $auth->emailValidation();

            if (empty($alerts)){
                $user = User::where('email', $auth->email);

                if ($user && $user->confirmed === '1'){
                    //generate new token
                    $user->generateToken();
                    $user->save();

                    // Send email
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendInstructions();

                    User::setAlert('exit', "We sent instructions to reset your account");

                }else{
                    User::setAlert('error', "The email dont exist or it's not confirmed");
                }
                $alerts = User::getAlerts();

            }
        }

        $router->render("auth/forgot-password", [
            'alerts' => $alerts
        ]);
    }

    //recover password with a token
    public static function recoverPassword(Router $router)
    {
        $alerts = [];
        $token = s($_GET['token']);
        $error = false;

        if (!$token){
            header('Location: /');
        }

        // search user by token
        $user = User::where('token', $token);

        if (empty($user)){
            User::setAlert('error', "Token not valid or expired");
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            // read and save new password
            $password = new User($_POST);

            $alerts = $password->passwordValidation();

            if (empty($alerts)){
                $user->password = $password->password;
                $user->hashPassword();
                $user->token = "";

                $result = $user->save(); // uploading

                if ($result){
                    header('Location: /'); //redirection
                }

            }
        }


        $alerts = User::getAlerts();

        $router->render("auth/recover-password", [
            'alerts' => $alerts,
            'error' => $error
        ]);
    }

    public static function message(Router $router)
    {
        $router->render("auth/message");
    }

    // confirm password
    public static function confirm(Router $router)
    {
        $alerts = [];
        $token = s($_GET['token']);
        
        //validation ,cant enter if not token
        if (!$token){
            header('Location: /');
        }

        $user = User::where('token', $token);

        if (empty($user)){
            // message error
            User::setAlert("error", "Invalid token");
        }else{
            $user->confirmed = "1";
            $user->token = "";
            $user->save();
            User::setAlert("exit", "Validation completed successfully! :)");
        }

        $alerts = User::getAlerts();

        // RENDER VIEW
        $router->render("auth/confirm-account", [
            'alerts' => $alerts
        ]);
    }

}
