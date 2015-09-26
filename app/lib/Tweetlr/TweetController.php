<?php
namespace Tweetlr;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class TweetController {
  public function recent(Request $req, Application $app) {
    $tweets = $app['db']->fetchAll('select * from recent limit 10');
    return $app['twig']->render('tweets.twig', array('tweets'=>$tweets));
  }
}