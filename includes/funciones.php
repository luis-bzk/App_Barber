<?php

function debug($variable) : string 
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// sintetize HTML
function s($html) : string
{
    return htmlspecialchars($html);
}

// not session
function notSession()
{
    if (!$_SESSION){
        header('Location: /');
    }
}

// user start session function
function isAuth() : void 
{
    if(!isset($_SESSION['login'])){
        header('Location: /');
    }
}

function isAdmin() : void 
{
    
    if(!isset($_SESSION['admin'])){
        header('Location: /');
    }
}

// function isSession() : void
// {
//     if(!isset($_SESSION)){
//         header('Location: /');
//     }
// }

// debug eith fetch on php :)
function debugFetch($name, $element)
{
    return json_encode([$name => $element]);
}


function isLast(string $current, string $next): bool
{
    if($current !== $next){
        return true;
    }
    return false;

}