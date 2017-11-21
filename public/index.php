<?php

use Webbala\Application\Bootstrap\DiKeys;

defined('APPLICATION_ENV') ?: define('APPLICATION_ENV', (
    getenv('APPLICATION_ENV') ?: 'production'
));

define('PROJECT_PATH', dirname(dirname(__FILE__)));
define('APPLICATION_PATH', PROJECT_PATH . '/src/Application/');
define('INFRASTRUCTURE_PATH', PROJECT_PATH . '/src/Infrastructure/');
define('VENDOR_PATH', PROJECT_PATH . '/vendor/');

include VENDOR_PATH . 'autoload.php';

/** @var \Slim\Container $container */
$container = include APPLICATION_PATH . 'Bootstrap/dependencies.php';

$app = new \Slim\App($container);

$app->post('/getVouchers', function ($request, $response, $args) use ($container) {
    /** @var \Webbala\Application\Controllers\VoucherController $voucherController */
    $voucherController = $container->get(DiKeys::VOUCHER_CONTROLLER);
    return $voucherController->getVoucherCodes($request, $response, $args);
});

$app->run();