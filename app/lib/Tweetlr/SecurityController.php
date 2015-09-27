<?php
# adapted from:
# http://silex.sensiolabs.org/doc/providers/security.html
namespace Tweetlr;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityController {

  public function login(Request $request, Application $app) {
    return $app['twig']->render('login.twig', array(
      'last_username' => $app['session']->get('_security.last_username'),
      'error'         => $app['security.last_error']($request),
    ));
  }

  public function currentUsername(Application $app) {

    if ($app['security.authorization_checker']
	  ->isGranted('IS_AUTHENTICATED_FULLY')) {
      return $app['security.token_storage']->getToken()->getUsername();
    } else return "anon";
  }

}
