<?php

function conectarDB(): mysqli{
    $db = new mysqli(
        $_ENV["DB_HOST"],
        $_ENV["DB_USER"],
        $_ENV["DB_PASS"],
        $_ENV["DB_BD"]
    );

    // debug($_ENV);

    if (!$db) {
        echo "No se pudo conectar a MySQL";
        exit;
    }
    return $db;
}