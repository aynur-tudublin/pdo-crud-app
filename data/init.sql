-- I don't need the commented lines as the db is created in ddev docker container
-- I had issues setting up other environments on my old MacBook, so ddev is
-- is the only option that worked for me.
-- CREATE DATABASE IF NOT EXISTS test;
-- USE test;

CREATE TABLE IF NOT EXISTS users (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(30) NOT NULL,
  lastname  VARCHAR(30) NOT NULL,
  email     VARCHAR(50) NOT NULL,
  age       INT(3),
  location  VARCHAR(50),
  date      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
