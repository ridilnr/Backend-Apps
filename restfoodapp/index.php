<?php
use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
// Use Loader() to autoload our model
$loader = new Loader();

$loader->registerDirs(
    [
        __DIR__ . '/app/models/'
    ]
);

$loader->register();

$di = new FactoryDefault();

// Set up the database service
$di->set('db', function () {
    return new PdoMysql(
        [
            'host'     => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'foodapp',

        ]
    );
}
);

// Create and bind the DI to the application
$app = new Micro($di);

//
//$url = new Url();
require_once "./app/view/Admin/Admin.php";
require_once "./app/view/Adminrestaurant/Adminrestaurant.php";
require_once "./app/view/Cities/Cities.php";
require_once "./app/view/Countries/Countries.php";
require_once "./app/view/Customers/Customers.php";
require_once "./app/view/Drinks/Drinks.php";
require_once "./app/view/Foods/Foods.php";
require_once "./app/view/Oldorderdrink/Oldorderdrink.php";
require_once "./app/view/Oldorderfood/Oldorderfood.php";
require_once "./app/view/Oldordersummary/Oldordersummary.php";
require_once "./app/view/Orderdrink/Orderdrink.php";
require_once "./app/view/Orderfood/Orderfood.php";
require_once "./app/view/Ordersummary/Ordersummary.php";
require_once "./app/view/Users/Users.php";
require_once "./app/view/Authentification.php";

/*
***************************** UNKNOWN METHOD AND OTHERS ERRORS *****************************
 */

//
$app->notFound( function () use ($app) {
    $app->response->setHeader('Content-Type', 'application/json');
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    $app->response->setJsonContent([
        'status' => 'Requested resource can not be found'
    ])->send();
});

$app->handle();