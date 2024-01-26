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
  `description` varchar(1000) NOT NULL,
  `image_url` varchar(255) NOT NULL
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

INSERT INTO CINEMA_HALLS (name, rows, seats_in_row) VALUES
  ('Gold Hall', 10, 15),
  ('Silver Hall', 8, 12),
  ('Platinium Hall', 12, 20);

INSERT INTO MOVIES (title, minutes, description, image_url) VALUES
  ('Indiana Jones', 120, ' The movie follows the legendary archaeologist and adventurer, Dr. Indiana Jones, played by Harrison Ford, on a quest to find the Ark of the Covenant before the Nazis can obtain its supernatural powers. Set in the 1930s, the film is filled with thrilling action sequences, memorable characters, and a sense of humor.', 'images/image1.jpg'),
  ('Star Wars', 105, 'Set in a distant galaxy, the story follows Luke Skywalker, played by Mark Hamill, a young farm boy who becomes embroiled in the Rebel Alliances fight against the tyrannical Galactic Empire. Assisted by Jedi Master Obi-Wan Kenobi, the charismatic smuggler Han Solo, and the droids C-3PO and R2-D2, Luke sets out on a journey to rescue Princess Leia, portrayed by Carrie Fisher, and deliver the plans to the Death Star, a powerful space station capable of destroying entire planets.', 'images/image3.jpg'),
  ('Avengers', 95, 'The story follows the aftermath of "Avengers: Infinity War," where the villain Thanos successfully wiped out half of all life in the universe. In "Endgame," the surviving Avengers embark on a time-traveling mission to collect the Infinity Stones and undo Thanos devastating snap. The film explores themes of sacrifice, heroism, and the enduring strength of the human spirit.', 'images/image2.jpg');

INSERT INTO USERS (username, password, admin) VALUES
  ('admin', 'adminpassword', 1),
  ('michal', '123456', 0),
  ('user2', 'user2password', 0);

INSERT INTO SEANCES (movie_id, hall_id, date, start_time) VALUES
  (1, 1, '2024-01-27', '18:00:00'),
  (2, 2, '2024-01-28', '19:30:00'),
  (3, 3, '2024-01-29', '20:15:00');

INSERT INTO RESERVATIONS (user_id, seance_id, seat_id) VALUES
  (2, 1, 5),
  (2, 1, 6),
  (3, 2, 10),
  (1, 3, 15),
  (1, 3, 16),
  (1, 3, 17);
