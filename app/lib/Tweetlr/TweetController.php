<?php
namespace Tweetlr;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class TweetController {

  private function _render($app, $title, $tweets) {
    return $app['twig']->render('tweets.twig', array(
      'title'=>$title,
      'logged_in'=> $app['security']->isGranted('IS_FULLY_AUTHENTICATED'),
      'username'=> $app['security']->getToken()->getUser(),
      'tweets'=>$tweets));
  }


  public function recent(Request $req, Application $app) {
    $tweets = $app['db']->fetchAll('select * from recent limit 16');
    return $this->_render($app, "Recent Tweets", $tweets);
  }

  public function by(Request $req, Application $app, $username) {
    $tweets = $app['db']->fetchAll('select * from recent where username = ?',
				   array($username));
    return $this->_render($app, "Tweets by $username", $tweets);
  }

}
