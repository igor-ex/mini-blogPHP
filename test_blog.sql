create table blog_entries(
  id int not null auto_increment primary key,
  text text not null,
  name varchar(25) not null,
  time timestamp not null default current_timestamp,
  key(time)
) engine=InnoDB default charset=utf8;

create table blog_comments(
  id int not null auto_increment primary key,
  blog_entry_id int not null references blog_entries(id),
  name varchar(25) not null,
  text text not null,
  time timestamp not null default current_timestamp,
  key(blog_entry_id),
  key(time)
) engine=InnoDB charset=utf8;