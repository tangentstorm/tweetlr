<?php
require_once '/cfg/vendor/autoload.php';

use Silex\Application;
use Silex\Provider;
use Symfony\Component\HttpFoundation\Response;

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
    return new Response($app['twig']->render('login.twig'));
});

$app->get('/hello/{name}', function ($name) use($app) {
    return $app['twig']->render('hello.twig',
				array('name' => $name, ));
});


$app->error(function (\Exception $e, $code) {
    return new Response("<h1>internal error</h1> ".$e['message']);
});

$app->run();
