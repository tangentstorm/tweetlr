<?php
require_once '/cfg/vendor/autoload.php';

use Silex\Application;
use Silex\Provider;
use Symfony\Component\HttpFoundation\Response;
use Tweetlr\UserProvider;

# -- service providers  ----------------------------------------

$app = new Application();
$app->register(new Provider\DoctrineServiceProvider());
$app->register(new Provider\SecurityServiceProvider());
$app->register(new Provider\SessionServiceProvider());
$app->register(new Provider\RememberMeServiceProvider());

$app->register(new Provider\UrlGeneratorServiceProvider());
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

$app['security.firewalls'] = array(
  'secured' => array(
    'pattern' => '^/hello/.*$',
    'form' => array( 'login_path'=> '/login', 'check_path' => 'login_check'),
    'users' => $app->share(function() use ($app) {
        return new UserProvider($app['db']);
     }),
  )
);


# -- template filters  -----------------------------------------

$app['twig'] = $app->extend("twig", function ($twig, $app) {

  # convert '@name' into a hyperlink
  $twig->addFilter(new Twig_SimpleFilter('linkify', function($str) {
    $s = preg_replace('/@(\w+)/', '<a href="/by/$1">@$1</a>', $str);
    return $s;
  }, array('is_safe'=>array('html'))));

  return $twig;
});


# -- controllers -----------------------------------------------

$app->get('/', 'Tweetlr\TweetController::recent');

$app->get("/login", function () use ($app) {
  return new Response($app['twig']->render('login.twig'));
});

$app->get('/by/{username}', 'Tweetlr\TweetController::by');

$app->error(function (\Exception $e, $code) {
  return new Response("<h1>internal error</h1> ".$e->getMessage());
});

$app->run();
