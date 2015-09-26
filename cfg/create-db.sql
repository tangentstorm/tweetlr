create database if not exists tweetlr;
grant all on tweetlr.* to 'tweetlr'@'localhost' identified by 'tweetlr';

use tweetlr;

create table if not exists users (
   uid integer not null auto_increment primary key,
   username varchar(32) not null unique,
   passhash char(32) not null
);

create table if not exists tweets (
  tid integer not null auto_increment primary key,
  uid integer not null references users.id,
  tweet varchar(140) not null
);


replace into users values
  (1, 'admin', md5('admin')),
  (2, 'samc', md5('Abner')),
  (3, 'dparker', md5('alg0nqu1n')),
  (4, 'groucho', md5('10021890'));


replace into tweets values
  ( 1, 2, 'Do the right thing. It will gratify some people and astonish the rest.'),
  ( 2, 3, 'Brevity is the soul of lingerie.'),
  ( 3, 2, 'All you need in this life is ignorance and confidence, then success is sure.'),
  ( 4, 4, 'I''ve had a perfectly wonderful evening. But this wasn''t it.'),
  ( 5, 3, 'There''s a hell of a distance between wise-cracking and wit. Wit has truth in it; wise-cracking is simply calisthenics with words.'),
  ( 6, 2, 'If you tell the truth, you don''t have to remember anything.'),
  ( 7, 3, 'If I didn''t care for fun and such, I''d probably amount to much. But I shall stay the way I am, because I do not give a damn.'),
  ( 8, 4, 'The secret of life is honesty and fair dealing. If you can fake that, you''ve got it made.');


create or replace view recent as
  select tid, u.username, t.tweet
  from tweets t left join users u on t.uid = u.uid
  order by tid desc;
