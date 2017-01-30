<?php
	use Silex\Application;
	use Symfony\Component\HttpFoundation\Request;
	use post2people\httpkernel\services\providers\TicketServiceProvider;

	class Post2PeopleApplication extends Application{
		private $name;

		public function __construct($parameters=[]){
			parent::__construct($parameters);
			$this["debug"] = true;
		}

		public function getName(){
			return $this->name;
		}

		public function setName($name){
			$this->name = $name;
		}
	}

	$app = new Post2PeopleApplication();
	$app->setName("post2people-web-app");

	//Register TicketServiceProvider
	$app->register(new TicketServiceProvider(), [
			"ticket.name" => "Walmart",
			"ticket.sucursal" => "Puerto Vallarta, Jalisco"
		]);

	return $app;