<?php

/**
 * Details for connecting to the database.
 */
$databaseConfig = [
    "dsn"             => "mysql:host=localhost;dbname=oophp;",
    "username"        => "user",
    "password"        => "pass",
    "driver_options"  => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
];

return $databaseConfig;
