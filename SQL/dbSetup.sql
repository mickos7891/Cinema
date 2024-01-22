CREATE DATABASE CINEMA

CREATE TABLE USERS (
    id int,
    username varchar,
    password varchar,
    admin bit,
    PRIMARY KEY (id)
); 

CREATE TABLE MOVIES (
    id int,
    title varchar,
    minutes int,
    PRIMARY KEY (id)
); 

CREATE TABLE CINEMA_HALL (
    id int,
    name varchar,
    rows int,
    seats_in_row int,
    PRIMARY KEY (id)
);

CREATE TABLE SEANCES (
    id int,
    movie_id int,
    hall_id int,
    start_time date,
    PRIMARY KEY (id)
); 

CREATE TABLE RESERVATIONS (
    id int,
    user_id int,
    seance_id int,
    seat_id int,
    PRIMARY KEY (id)
); 


GO