<?php
namespace Tweetlr;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class TweetController {

  private function _render($app, $title, $tweets) {
    return $app['twig']->render('tweets.twig', array(
      'title' => $title,
      'logged_in'=> $app['security']->isGranted('IS_FULLY_AUTHENTICATED'),
      'username'=> $app['security']->getToken()->getUser(),
      'tweets' => $tweets));
  }


  public function recent(Request $req, Application $app) {
    return $this->_render($app, "Recent Tweets",
			  $app['tweets']->recent());
  }

  public function by(Request $req, Application $app, $username) {
    return $this->_render($app, "Tweets by $username",
			  $app['tweets']->by($username));
  }

}
