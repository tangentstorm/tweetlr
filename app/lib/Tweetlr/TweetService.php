<?php
namespace Tweetlr;

use Doctrine\DBAL\Connection;


class TweetService {

  public function __construct(Connection $db) {
    $this->db = $db;
  }

  public function recent() {
    return $this->db->fetchAll('select * from recent limit 16');
  }

  public function by($username) {
    return $this->db->fetchAll('select * from recent where username = ?',
			       array($username));
  }

}
