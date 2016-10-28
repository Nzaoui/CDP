CREATE DATABASE GestionDeProjet;

USE GestionDeProjet;

CREATE TABLE User (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(50) NOT NULL,
	last_name VARCHAR(50) NOT NULL,
	login VARCHAR(50) NOT NULL,
	email VARCHAR(50) NOT NULL,
	password TEXT NOT NULL,
	PRIMARY KEY (id),
	UNIQUE(login),
	UNIQUE(email) );

CREATE TABLE Project (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	description TEXT NOT NULL,
	language VARCHAR(20) NOT NULL,
	owner INT UNSIGNED NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (owner) REFERENCES User(id));

CREATE TABLE WorkOn (
	id_user INT UNSIGNED NOT NULL,
	id_project INT UNSIGNED NOT NULL,
	PRIMARY KEY (id_user,id_project),
	FOREIGN KEY (id_user) REFERENCES User(id),
	FOREIGN KEY (id_project) REFERENCES Project(id));

CREATE TABLE Sprint (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_project INT UNSIGNED NOT NULL,
	start_date DATE NOT NULL,
	end_date DATE NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (id_project) REFERENCES Project(id));

CREATE TABLE UserStory (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_project INT UNSIGNED NOT NULL,
	description TEXT NOT NULL,
	priority INT NULL,
	achievement DATE NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (id_project) REFERENCES Project(id));

CREATE TABLE Task (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_sprint INT UNSIGNED NOT NULL,
	id_us INT UNSIGNED NOT NULL,
	id_user INT UNSIGNED NULL,
	description TEXT NOT NULL,
	state VARCHAR(20) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (id_sprint) REFERENCES Sprint(id),
	FOREIGN KEY (id_us) REFERENCES UserStory(id),
	FOREIGN KEY (id_user) REFERENCES User(id));
