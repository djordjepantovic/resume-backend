<?php

use Resume\Container\Reference\ParameterReference as PR;
use Resume\Container\Reference\ServiceReference as SR;

use Resume\Controllers\Home;
use Resume\Services\Validation;
use Resume\Router;
use Mailgun\Mailgun;

return [

    Twig_Loader_Filesystem::class => [
    	'class' => Twig_Loader_Filesystem::class,
    	'arguments' => [
            new PR('twig.loader')
        ],
    ],

    Twig_Environment::class => [
    	'class' => Twig_Environment::class,
    	'arguments' => [
            new SR(Twig_Loader_Filesystem::class)
        ],
    ],

	Mailgun::class => [
        'class' => Mailgun::class,
        'arguments' => [
            new PR('mailgun.key')
        ],
    ],

    Validation::class => [
        'class' => Validation::class,
    ],

    HomeController::class => [
    	'class' => Home::class,
    	'arguments' => [ 
    		new SR(Twig_Environment::class),
    	],
    	'calls' => [
			[
				'method' => 'send',
				'arguments' => [
	        		new SR(Mailgun::class),
	        		new SR(Validation::class),
	        	]
			],
        ],
    ],

    Router::class => [
    	'class' => Router::class,
    ],

];