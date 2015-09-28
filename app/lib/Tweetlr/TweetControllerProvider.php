<?php
namespace Tweetlr;

use Silex\Application;
use Silex\ControllerProviderInterface;

class TweetControllerProvider implements ControllerProviderInterface {


  public function connect(Application $app) {

    $cf = $app['controllers_factory'];
    
    $cf->get('/', 'Tweetlr\TweetController::recent');
    $cf->post("/tweet", 'Tweetlr\TweetController::tweet');
    $cf->get('/by/{username}', 'Tweetlr\TweetController::by');
    $cf->get('/login', 'Tweetlr\SecurityController::login');

    return $cf;

  }

}