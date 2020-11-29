<?php
/** BASE URL */
define("ROOT", "http://localhost/supermercado");

/** DATABASE CONNECT */
define("DATA_LAYER_CONFIG", [
    "driver" => "pgsql",
    "host" => "localhost",
    "port" => "5432",
    "dbname" => "postgres",
    "username" => "postgres",
    "passwd" => "x4Mb5Ye8",
    "options" => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);


function url(string $path): string
{
    
    
    if ($path) {
        return ROOT . "{$path}";
    }
    return ROOT;
}

function message(string $message, string $type): string
{
    return "<div class=\"message {$type}\">{$message}</div>";
}