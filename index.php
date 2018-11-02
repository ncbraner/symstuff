<?php

require_once 'vendor/autoload.php';


use App\Services\MailService;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use App\Controllers\IndexController;

$routes = require_once 'routes.php';
$request = Request::createFromGlobals();
$context = new RequestContext();
$context->fromRequest($request);

$containerBuilder = new ContainerBuilder();
$containerBuilder->autowire(IndexController::class, IndexController::class)
    ->setPublic(true);
$containerBuilder->autowire(MailService::class, MailService::class)
    ->setPublic(false);

$matcher = new UrlMatcher($routes, $context);
$match = $matcher->match($request->getPathInfo());

$containerBuilder->getDefinition(IndexController::class)->setArgument('$message', 'This is the message');
$containerBuilder->compile();

$app = $containerBuilder->get(IndexController::class);
$method = $match['_method'];
echo $app->$method();
