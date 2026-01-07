-- Création de la base de données covoiturage_db
CREATE DATABASE covoiturage_db CHARACTER SET utf8mb4;
USE covoiturage_db;

-- création de la table des utilisateurs (users)
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  lastname VARCHAR(50),
  firstname VARCHAR(50),
  phone VARCHAR(20),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role ENUM('USER','ADMIN') DEFAULT 'USER'
);

-- création de la table pour les agences (agencies)
CREATE TABLE agencies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) UNIQUE
);

-- création de la table pour les trajets (trips)
CREATE TABLE trips (
  id INT AUTO_INCREMENT PRIMARY KEY,
  departure_agency_id INT,
  arrival_agency_id INT,
  departure_datetime DATETIME,
  arrival_datetime DATETIME,
  total_seats INT,
  available_seats INT,
  user_id INT,
  FOREIGN KEY (departure_agency_id) REFERENCES agencies(id),
  FOREIGN KEY (arrival_agency_id) REFERENCES agencies(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);
