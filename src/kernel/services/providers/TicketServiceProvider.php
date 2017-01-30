<?php 
	namespace post2people\httpkernel\services\providers;

	use Silex\Application;
	use Silex\ServiceProviderInterface;
	use post2people\httpkernel\services\core\system\TicketService;


	class TicketServiceProvider implements ServiceProviderInterface{
		/**
		 * @Override
		 */
		public function register(Application $app){
			/**
			 * parameters:
			 * 	-ticket.name: business name.
			 * 	-ticket.sucursal: sucursal name.
			 */
			
			$app["ticket.service"] = $app->share(function() use($app){
				$ticketservice = new TicketService();

				$ticketservice->setName($app["ticket.name"]);
				
				$ticketservice->setSucursal($app["ticket.sucursal"]);

				return $ticketservice;
			});
		}
		
		/**
		 * @Override
		 */
		public function boot(Application $app){}
	}