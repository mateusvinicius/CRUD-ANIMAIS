<?php
/**
 * Created by PhpStorm.
 * User: Mateus
 * Date: 17/01/2018
 * Time: 16:57
 */


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'config/config.php';
require 'vendor/autoload.php';
require 'config/constants.php';

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer('Templates/');

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};


require 'app/routes.php';

$app->run();