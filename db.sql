-- create database
CREATE DATABASE todo_list;

-- create table task
CREATE TABLE task (
    id int NOT NULL AUTO_INCREMENT,
    item VARCHAR(255) NOT NULL,
    status int DEFAULT 0,
    PRIMARY KEY(id)
);