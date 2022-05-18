<?php

    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'mail');
    define('DOMAIN_APP', 'http://localhost/mail/');

    /* Attempt to connect to MySQL database */
    try{
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $GLOBALS['conn'] = $pdo;
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        mysqli_set_charset($db, "utf8mb4");
    } catch(PDOException $e){
        $GLOBALS['e'] = $e;
        die("ERROR: Could not connect. " . $e->getMessage());
    }

    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $domain = DOMAIN_APP;
    $admin = $domain.'admin/';

    date_default_timezone_set("Asia/Jakarta");