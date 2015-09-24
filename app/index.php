<?php
require_once '/cfg/vendor/autoload.php';

$app = new Silex\Application();
$app->register(new Silex\Provider\TwigServiceProvider(),
	       array('twig.path' => __DIR__.'/views'));


$app->get('/', function() {
    return "Hello World!";

})->before(function ($request, $app) {
    return new Symfony\Component\HttpFoundation\Response(
      $app['twig']->render('login.twig'));
});

$app->get('/hello/{name}', function ($name) use($app) {
    return $app['twig']->render('hello.twig',
				array('name' => $name, ));
});

$app->run();
