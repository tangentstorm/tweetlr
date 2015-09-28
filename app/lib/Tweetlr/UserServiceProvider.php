<?php
namespace Tweetlr;

use Silex\Application;
use Silex\ServiceProviderInterface;


class UserServiceProvider implements ServiceProviderInterface {

  public function register(Application $app) {

    $app['user.name'] = function() use ($app) {
      return $app['security']->getToken()->getUser();
    };

    $app['user.logged_in'] = function() use ($app) {
      return $app['security']->isGranted('IS_FULLY_AUTHENTICATED');
    };

  }

  public function boot(Application $app) {
    # nothing to do.
  }

}
