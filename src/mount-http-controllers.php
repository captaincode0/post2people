<?php 
	use Symfony\Component\HttpFoundation\Request;
	use post2people\httpkernel\controller\view\FrontPageControllers;
	use post2people\httpkernel\controller\view\TicketControllers;


	$app->mount("/", new FrontPageControllers());
	$app->mount("/ticket", new TicketControllers());
