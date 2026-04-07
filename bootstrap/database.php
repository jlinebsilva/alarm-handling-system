<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


$driver = $_ENV['DB_DRIVER'];
$host = $_ENV['DB_HOST'];
$dbuser = $_ENV['DB_USER'];
$dbpswd = $_ENV['DB_PSWD'];
$dbname = $_ENV['DB_NAME'];


try {
    $pdo = new PDO("$driver:host=$host", $dbuser, $dbpswd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`
                CHARACTER SET utf8
                COLLATE utf8_unicode_ci");

} catch (PDOException $e) {
    die("Erro ao criar database >> " . $e->getMessage());
}

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => $driver,
    'host' => $host,
    'database' => $dbname,
    'username' => $dbuser,
    'password' => $dbpswd,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

?>