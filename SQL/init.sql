CREATE DATABASE CINEMA;
USE CINEMA;

CREATE TABLE SEANCES (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `movie_id` int NOT NULL,
  `hall_id` int NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL
);

CREATE TABLE `CINEMA_HALLS` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) NOT NULL,
  `rows` int NOT NULL,
  `seats_in_row` int NOT NULL
);

CREATE TABLE `RESERVATIONS` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int NOT NULL,
  `seance_id` int NOT NULL,
  `seat_id` int NOT NULL
);

CREATE TABLE `MOVIES` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(50) NOT NULL,
  `minutes` int NOT NULL,
  `description` varchar(250) NOT NULL
);

CREATE TABLE `USERS` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `admin` bit NOT NULL
);

ALTER TABLE `RESERVATIONS`
ADD FOREIGN KEY (`seance_id`) REFERENCES `SEANCES` (`id`);

ALTER TABLE `RESERVATIONS`
ADD FOREIGN KEY (`user_id`) REFERENCES `USERS` (`id`);

ALTER TABLE `SEANCES`
ADD FOREIGN KEY (`movie_id`) REFERENCES `MOVIES` (`id`);

ALTER TABLE `SEANCES`
ADD FOREIGN KEY (`hall_id`) REFERENCES `CINEMA_HALLS` (`id`);