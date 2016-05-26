<?php

require __DIR__.'/../vendor/autoload.php';

$container = include __DIR__.'/../config/container.php';
$app = new \Resume\App($container);
$app->setUpConfig(__DIR__.'/../.env');

require 'routes.php';