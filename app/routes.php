<?php

$app->get('/', function () use ($app) {
    $home = $app->container->get(HomeController::class);
    $home->index();
});

$app->post('/send', function () use ($app) {
	 $home = $app->container->get(HomeController::class);
	 $home->send();
});

$app->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404, route not found!';
});