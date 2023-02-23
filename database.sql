drop database if exists replication;
create database replication;
use replication;

create table users (
	id int(8) not null primary key auto_increment,
	name varchar(32),
	color varchar(16) not null
);
create table curseurs (
	userId int(8) not null,
	x int(8) not null,
	y int(8) not null
);
