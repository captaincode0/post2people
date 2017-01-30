<?php
	namespace post2people\httpkernel\controller\view;
	
	use Silex\Application;
	use Silex\ControllerProviderInterface;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\JsonResponse;

	class FrontPageControllers implements ControllerProviderInterface{
		/**
		 * @Override
		 */
		public function connect(Application $app){
			$controllers = $app["controllers_factory"];

			$controllers->get("/", function() use($app){
				return "<h1>Hello World</h1>";
			});

			$controllers->get("/contact", function() use($app){
				return "<h1>Contact Page</h1>";
			});

			$controllers->get("/say/hello/{name}", function(Request $request, $name) use($app){
				$age = $request->get("age");

				return "<h1>Hello $name, you are $age years old</h1>";
			})
				->before(function(Request $request, Application $app){
					$age = $request->get("age");

					if(!preg_match("/^\d+$/", $age))
						return new JsonResponse(array("error" => "El parámetro edad debe ser un número"), 401);
				});

			$controllers->after(function(Request $request, Response $response) use($app){
				$response->headers->set("content-type", "text/html");
			});

			return $controllers;
		}
	}