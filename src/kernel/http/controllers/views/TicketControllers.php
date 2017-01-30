<?php
	namespace post2people\httpkernel\controller\view;
	
	use Silex\Application;
	use Silex\ControllerProviderInterface;
	

	class TicketControllers implements ControllerProviderInterface{
		public function connect(Application $app){
			$controllers = $app["controllers_factory"];

			$controllers->get("/view", function() use($app){		
				$print =  $app["ticket.service"]->getCount().":".$app["ticket.service"]->getName().":".$app["ticket.service"]->getSucursal();

				$app["ticket.service"]->newTicket();
				
				return $print;
			});

			return $controllers;
		}
	}