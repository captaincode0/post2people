-- Copyright (C) 2017  captaincode

-- This program is free software: you can redistribute it and/or modify it
-- under the terms of the GNU General Public License as published by the Free
-- Software Foundation, either version 3 of the License, or (at your option)
-- any later version.

-- This program is distributed in the hope that it will be useful, but WITHOUT
-- ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
-- FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
-- more details.

-- You should have received a copy of the GNU General Public License along
-- with this program.  If not, see <http://www.gnu.org/licenses/>.

drop database if exists post2peopledb;
create database post2peopledb;
use post2peopledb;

/**
 * @authors: captaincode0, kevr, codeghost.
 */

/**
 * Tables
 */

drop table if exists users;
create table users (
	id bigint unsigned not null primary key auto_increment,
	email varchar(60) not null,
	passwd char(32) not null,
	username varchar(50) not null,
	picture text not null,
	isactive tinyint(1) not null default 0
)engine=innodb;

drop table if exists accountactivation;
create table accountactivation (
	userid bigint unsigned not null,
	token char(32) null,
	isactive tinyint(1) not null default 1
)engine=innodb;

alter table accountactivation 
	add constraint fk_users0
		foreign key accountactivation (userid)
			references users (id)
				on update no action
				on delete cascade;

drop table if exists passwordrecovery;
create table passwordrecovery (
	userid bigint unsigned not null,
	token char(32) null,
	isactive tinyint(1) not null default 1
)engine=innodb;

alter table passwordrecovery
	add constraint fk_users1
		foreign key passwordrecovery (userid)
			references users (id)
				on update no action
				on delete cascade;

drop table if exists posts;
create table posts (
	id bigint unsigned not null primary key auto_increment,
	userid bigint unsigned not null,
	name varchar(45) not null,
	image text not null,
	descr text not null,
	tstamp timestamp null,
	token char(32) null,
	likes bigint unsigned not null,
	dislikes bigint unsigned not null
)engine=innodb; 

alter table posts
	add constraint fk_users2
		foreign key posts (userid)
			references users (id)
				on update no action
				on delete cascade;

drop table if exists comments;
create table comments (
	postid bigint unsigned not null,
	userid bigint unsigned not null,
	content text not null
)engine=innodb;

alter table comments
	add constraint fk_posts0 
		foreign key comments (postid)
			references posts (id)
				on update no action 
				on delete cascade;

alter table comments
	add constraint fk_comments
		foreign key comments (userid)
			references users (id)
				on update no action
				on delete cascade;

drop table if exists hashtags;
create table hashtags (
	id bigint unsigned not null primary key auto_increment,
	hashtag text not null
)engine=innodb;

drop table if exists relhashtagstoposts;
create table relhashtagstoposts (
	hashtagid bigint unsigned not null,
	postid bigint unsigned not null
)engine=innodb;

alter table relhashtagstoposts
	add constraint fk_hastags0
		foreign key relhashtagstoposts (hashtagid)
			references hashtags (id)
				on update no action
				on delete cascade;

alter table relhashtagstoposts
	add constraint fk_posts1
		foreign key relhashtagstoposts (postid)
			references posts (id)
				on update no action
				on delete cascade;

drop table if exists sitemap;
create table sitemap (
	id bigint unsigned not null primary key auto_increment,
	url text not null,
	changefreq enum("daily", "weekly", "monthly", "yearly") not null,
	priority float(3,2) not null default 0.5
)engine=innodb;

/**
 * Views
 * vw<viewname> as (
 * 		definition
 * );
 *
 * 	+ vwPostsQuantityByHashTag: get que quantity of posts by hashtags.
 * 	+ vwPostsQuantityByUser: get the quantity of posts by user posts.
 * 	+ vwHashtagsQuantityByUserPosts: get the quantity of hash tags by user posts.
 * 	+ vwLikesAndDislikesQuantityByUserPosts: get the quantity of likes and dislikes by user posts.
 * 	+ vwCommentsQuantityByUserPosts: get the quantity of comments by user posts.
 * 	+ vwTrendingTopic: get the hash tags with maxmimun posts.
 */

create view vwPostsQuantityByHashTag as (
	select hashtagid, count(postid) as quantity 
		from relhashtagstoposts
			order by hashtagid asc 
			group by hashtagid
);

create view vwPostsQuantityByUser as (
	select userid, count(posts.id) as quantity
		from posts
			order by userid asc
			group by userid
);

create view vwHashtagsQuantityByUserPosts (
	/*More code*/
);