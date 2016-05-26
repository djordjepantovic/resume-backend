<?php

namespace Resume\Core;

use Twig_Environment;

abstract class Controller
{
	protected $view;

	public function __construct(Twig_Environment $twig)
	{
		$this->view = $twig;
	}
}