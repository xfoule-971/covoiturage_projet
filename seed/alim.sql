-- insertion des agences dans la table agencies
INSERT INTO agencies (name) VALUES
('Paris'),('Lyon'),('Marseille'),('Toulouse'),
('Nice'),('Nantes'),('Strasbourg'),
('Montpellier'),('Bordeaux'),('Lille'),
('Rennes'),('Reims');

-- exemple d'insertion des données dans la table users avec mise en évidence de l'administrateur
INSERT INTO users (lastname, firstname, phone, email, password, role) VALUES
('Martin','Alexandre','0612345678','alexandre.martin@email.fr', PASSWORD('password'),'ADMIN'),
('Dubois','Sophie','0698765432','sophie.dubois@email.fr', PASSWORD('password'),'USER'),
('Bernard','Julien','0622446688','julien.bernard@email.fr', PASSWORD('password'),'USER');

-- mise en place de trajets dans la table trips
INSERT INTO trips (departure_agency_id, arrival_agency_id, departure_datetime, arrival_datetime, total_seats, available_seats, user_id) VALUES
(1, 2, '2026-01-02 08:00:00', '2026-01-02 12:00:00', 4, 3, 1),
(2, 3, '2026-01-02 09:30:00', '2026-01-02 14:00:00', 5, 2, 2),
(3, 4, '2026-01-03 07:00:00', '2026-01-03 11:30:00', 4, 4, 3),
(4, 5, '2026-01-03 10:00:00', '2026-01-03 15:00:00', 6, 1, 4),
(5, 1, '2026-01-04 06:00:00', '2026-01-04 12:00:00', 3, 0, 5),
(1, 3, '2026-01-04 14:00:00', '2026-01-04 18:30:00', 5, 2, 6),
(2, 4, '2026-01-05 08:00:00', '2026-01-05 13:00:00', 4, 3, 7),
(3, 5, '2026-01-05 09:00:00', '2026-01-05 14:00:00', 6, 4, 8),
(4, 1, '2026-01-06 07:30:00', '2026-01-06 12:30:00', 5, 1, 9),
(5, 2, '2026-01-06 10:00:00', '2026-01-06 15:00:00', 4, 2, 10),
(1, 4, '2026-01-07 08:15:00', '2026-01-07 12:45:00', 5, 3, 11),
(2, 5, '2026-01-07 09:45:00', '2026-01-07 14:15:00', 4, 4, 12),
(3, 1, '2026-01-08 07:30:00', '2026-01-08 12:00:00', 6, 2, 13),
(4, 2, '2026-01-08 10:00:00', '2026-01-08 15:00:00', 5, 3, 14),
(5, 3, '2026-01-09 06:45:00', '2026-01-09 12:15:00', 4, 0, 15),
(1, 5, '2026-01-09 14:00:00', '2026-01-09 19:00:00', 5, 2, 16),
(2, 1, '2026-01-10 08:00:00', '2026-01-10 12:30:00', 4, 4, 17),
(3, 2, '2026-01-10 09:30:00', '2026-01-10 14:00:00', 6, 3, 18),
(4, 3, '2026-01-11 07:00:00', '2026-01-11 11:30:00', 5, 1, 19),
(5, 4, '2026-01-11 10:00:00', '2026-01-11 15:00:00', 4, 2, 20);

-- création de l'utilisateur restreint
CREATE USER 'covoit_user'@'localhost'
IDENTIFIED BY 'MotDePasseSolide!2025';
GRANT SELECT, INSERT, UPDATE, DELETE
ON covoiturage_db.*
TO 'covoit_user'@'localhost';
FLUSH PRIVILEGES;