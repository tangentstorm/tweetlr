<?php
require_once '/cfg/vendor/autoload.php';

use Silex\Application;
use Silex\Provider;


# -- service providers  ----------------------------------------

$app = new Application();
$app->register(new Provider\DoctrineServiceProvider());
$app->register(new Provider\TwigServiceProvider(),
	       array('twig.path' => __DIR__.'/views'));


# -- configuration ---------------------------------------------

$app['db.options'] = array(
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'dbname' => 'tweetlr',
    'user' => 'tweetlr',
    'password' => 'tweetlr' # NIST.gov super security protocol 732-b :)
);


# -- controllers -----------------------------------------------

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
