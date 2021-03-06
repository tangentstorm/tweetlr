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
  -- !! note that these passwords aren't actually used at the moment,
  --    since the goal was just to build a single-user application.
  (1, 'tweetlr', md5('yay4tweetz')),
  (2, 'samuel', md5('Abner')),
  (3, 'dparker', md5('alg0nqu1n')),
  (4, 'groucho', md5('10021890')),
  (5, 'nancy', md5('viscountess79')),
  (6, 'winston', md5('bulldog')),
  (7, 'feynman', md5('123qed'));;

replace into tweets values
  ( 1, 2, 'Do the right thing. It will gratify some people and astonish the rest.'),
  ( 2, 3, 'Brevity is the soul of lingerie.'),
  ( 3, 2, 'All you need in this life is ignorance and confidence, then success is sure.'),
  ( 4, 4, 'I''ve had a perfectly wonderful evening. But this wasn''t it.'),
  ( 5, 3, 'There''s a hell of a distance between wise-cracking and wit. Wit has truth in it; wise-cracking is simply calisthenics with words.'),
  ( 6, 2, 'If you tell the truth, you don''t have to remember anything.'),
  ( 7, 3, 'If I didn''t care for fun and such, I''d probably amount to much. But I shall stay the way I am, because I do not give a damn.'),
  ( 8, 4, 'The secret of life is honesty and fair dealing. If you can fake that, you''ve got it made.'),
  ( 9, 5, 'The penalty for success is to be bored by the people that used to snub you.'),
  (10, 6, 'If you''re going through hell, keep going.'),
  (11, 5, '@winston, if you were my husband, I''d poison your tea.'),
  (12, 6, '@nancy, if you were my wife, I would drink it.'),
  (13, 7, 'The first principle is that you must not fool yourself, and you are the easiest person to fool.');


create or replace view recent as
  select tid, u.username, t.tweet
  from tweets t left join users u on t.uid = u.uid
  order by tid desc;
