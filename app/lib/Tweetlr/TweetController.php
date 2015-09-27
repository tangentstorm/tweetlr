<?php
namespace Tweetlr;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class TweetController {

  public function recent(Request $req, Application $app) {
    $tweets = $app['db']->fetchAll('select * from recent limit 16');
    return $app['twig']->render('tweets.twig', array('title'=>"Recent Tweets",
						     'tweets'=>$tweets));
  }

  public function by(Request $req, Application $app, $username) {
    $tweets = $app['db']->fetchAll('select * from recent where username = ?',
				   array($username));
    return $app['twig']->render('tweets.twig', array('title'=>"Posts by $username",
						     'tweets'=>$tweets));
  }

}
