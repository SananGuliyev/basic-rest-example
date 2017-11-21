<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Webbala\Application\Bootstrap\DiKeys;

$container = new \Slim\Container;

$container[DiKeys::APPLICATION_CONFIG] = function (){
    return yaml_parse_file(APPLICATION_PATH . 'config/' . APPLICATION_ENV . '.yaml');
};

$container[DiKeys::NOT_FOUND_HANDLER] = function () use ($container){
    return function (RequestInterface $request, ResponseInterface $response) use ($container) {
        return $container['response']
            ->withJson(
                [
                    'error' => 'Endpoint Not Found'
                ],
                404
            );
    };
};

$container[DiKeys::NOT_ALLOW_HANDLER] = function () use ($container){
    return function (RequestInterface $request, ResponseInterface $response, array $methods) use ($container) {
        return $container['response']
            ->withJson(
                [
                    'error' => 'Not Allowed'
                ],
                405
            );
    };
};

$container[DiKeys::SLIM_ERROR_HANDLER] = function () use ($container){
    return function (RequestInterface $request, ResponseInterface $response, Exception $exception) use ($container) {
        return $container['response']
            ->withJson(
                [
                    'error' => 'Something went wrong!',
                ],
                500
            );
    };
};

$container[DiKeys::RUNTIME_ERROR_HANDLER] = function () use ($container){
    return function (RequestInterface $request, ResponseInterface $response, Throwable $error) use ($container) {
        return $container['response']
            ->withJson(
                [
                    'error' => 'Something went wrong!'
                ],
                500
            );
    };
};

$container[DiKeys::DOCTRINE_ENTITY_MANAGER] = function () use ($container){
    $applicationConfig = $container->get(DiKeys::APPLICATION_CONFIG);
    $doctrineConfig = new \Doctrine\ORM\Configuration();
    $driver = new \Doctrine\ORM\Mapping\Driver\XmlDriver([
        INFRASTRUCTURE_PATH . '/Persistence/Doctrine/mapping'
    ]);
    $doctrineConfig->setMetadataDriverImpl($driver);
    $connection = [
        'driver' => 'pdo_mysql',
        'dbname' => $applicationConfig['database']['name'],
        'user' => $applicationConfig['database']['username'],
        'password' => $applicationConfig['database']['password'],
        'host' => $applicationConfig['database']['host']
    ];
    $proxyPath = INFRASTRUCTURE_PATH . 'Doctrine/Proxies';
    $doctrineConfig->setProxyDir($proxyPath);
    $doctrineConfig->setProxyNamespace('Webbala\Infrastructure\Proxies');
    $doctrineConfig->setAutoGenerateProxyClasses(true);

    return \Doctrine\ORM\EntityManager::create($connection, $doctrineConfig);
};

$container[DiKeys::OFFER_REPOSITORY] = function () use ($container){
    $entityManager = $container->get(DiKeys::DOCTRINE_ENTITY_MANAGER);
    return new \Webbala\Infrastructure\Persistence\Doctrine\OfferRepository($entityManager);
};

$container[DiKeys::RECIPIENT_REPOSITORY] = function () use ($container){
    $entityManager = $container->get(DiKeys::DOCTRINE_ENTITY_MANAGER);
    return new \Webbala\Infrastructure\Persistence\Doctrine\RecipientRepository($entityManager);
};

$container[DiKeys::VOUCHER_REPOSITORY] = function () use ($container){
    $entityManager = $container->get(DiKeys::DOCTRINE_ENTITY_MANAGER);
    return new \Webbala\Infrastructure\Persistence\Doctrine\VoucherRepository($entityManager);
};

$container[DiKeys::OFFER_CONTROLLER] = function () use ($container){
    return new \Webbala\Application\Controllers\OfferController(
        $container->get(DiKeys::OFFER_REPOSITORY),
        new \Webbala\Domain\Offer\Factory()
    );
};

$container[DiKeys::RECIPIENT_CONTROLLER] = function () use ($container){
    return new \Webbala\Application\Controllers\RecipientController(
        $container->get(DiKeys::RECIPIENT_REPOSITORY),
        new \Webbala\Domain\Recipient\Factory()
    );
};

$container[DiKeys::VOUCHER_CONTROLLER] = function () use ($container){
    return new \Webbala\Application\Controllers\VoucherController(
        $container->get(DiKeys::OFFER_REPOSITORY),
        $container->get(DiKeys::RECIPIENT_REPOSITORY),
        $container->get(DiKeys::VOUCHER_REPOSITORY)
    );
};

return $container;