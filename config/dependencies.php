<?php
use Slim\App;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;

/**
 * @var Container $container
 */
$container = $app->getContainer();

/**
 * @description Setup Monolog plugin
 * @return \Monolog\Logger
 * @throws Exception
 * @throws \Psr\Container\ContainerExceptionInterface
 * @throws \Psr\Container\NotFoundExceptionInterface
 */
$container['logger'] = function () use ($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Logger($settings['name']);
    $logger->pushProcessor(new UidProcessor());
    $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

/**
 * @description Setup CORS
 * @param Request $request
 * @param Response $response
 * @param App $next
 * @return \Psr\Http\Message\ResponseInterface|App
 * @throws \Slim\Exception\MethodNotAllowedException
 * @throws \Slim\Exception\NotFoundException
 */
$setupCors = function (Request $request, Response $response, App $next) {
    /** @var App $next */
   return $next($request, $response)
       ->withHeader(
           'Access-Control-Allow-Origin',
           '*'
       )
       ->withHeader(
           'Access-Control-Allow-Headers',
           'X-Requested-With, Content-Type, Accept, Origin, Authorization'
       )
       ->withHeader(
           'Access-Control-Allow-Methods',
           'GET, POST, PUT, DELETE, PATCH, OPTIONS'
       );
};
$app->add($setupCors);

/**
 * @description Setup 404 Not Found Page Error
 * @param Request $request
 * @param Response $response
 * @return Response
 */
$override404NotFoundPage = function (Request $request, Response $response) {
    /** @var Response $response */
    return $response->withJson([
        'status' => false
    ], 404);
};

$container['notFoundHandler'] = function() use($override404NotFoundPage) {
    return $override404NotFoundPage;
};