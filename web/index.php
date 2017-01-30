<?php
	error_reporting(E_ALL);

	//load the framework
	require __dir__."/../vendor/autoload.php";

	//build the services
	require __dir__."/../src/kernel/services/ServicesLoader.php";
	
	//build and get the current application
	$app = require __dir__."/../src/app.php";

	//build the controllers
	require __dir__."/../src/kernel/http/controllers/ControllersLoader.php";

	//mount the controllers
	require __dir__."/../src/mount-http-controllers.php";

	//run the application
	$app->run();