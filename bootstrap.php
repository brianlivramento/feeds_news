<?php

require __DIR__ . '/vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$container = $app->getContainer();

$container['view'] = function ($container) {
	$view = new \Slim\Views\Twig('../templates', [
		'cache' => '../templates/cache'
	]);
	$router = $container->get('router');
	$uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
	$view->addExtension(new Slim\Views\TwigExtension($router, $uri));

	return $view;
};

$app->get('/', function ($request, $response, $args) {
    return $this->view->render($response, 'midias/midia.html.twig');
});

$app->run();