<?php
namespace Tweetlr;

use Silex\Application;
use Silex\ControllerProviderInterface;

class TweetControllerProvider implements ControllerProviderInterface {


  public function connect(Application $app) {

    $cf = $app['controllers_factory'];
    
    $cf->get('/', 'Tweetlr\TweetController::recent');
    
    $cf->get('/by/{username}', 'Tweetlr\TweetController::by');
    
    $cf->get('/login', 'Tweetlr\SecurityController::login');
    
    $cf->get("/tweet", function () use ($app) {
	return "TODO: actually post tweets";
    });
    
    return $cf;

  }

}