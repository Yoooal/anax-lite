<?php

/**
 * Details for connecting to the database.
 */
$databaseConfig = [
    "dsn"             => "mysql:host=localhost;dbname=webshop;",
    "username"        => "user",
    "password"        => "pass",
    "driver_options"  => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
];

return $databaseConfig;
