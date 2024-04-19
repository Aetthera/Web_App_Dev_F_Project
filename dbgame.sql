-- Create the Database
CREATE DATABASE IF NOT EXISTS kidsGames;
USE kidsGames;

-- Create the Players Table
CREATE TABLE IF NOT EXISTS player(
    player_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(20) NOT NULL UNIQUE,
    registration_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE INDEX username_unique (username)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Create the Authenticator Table
CREATE TABLE IF NOT EXISTS authenticator(
    auth_id INT AUTO_INCREMENT PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    player_id INT NOT NULL,
    FOREIGN KEY (player_id) REFERENCES player(player_id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Create the Score Table
CREATE TABLE IF NOT EXISTS score(
    score_id INT AUTO_INCREMENT PRIMARY KEY,
    score_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    result ENUM('win', 'gameover', 'incomplete'),
    lives_used INT NOT NULL,
    player_id INT,
    FOREIGN KEY (player_id) REFERENCES player(player_id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Insert Sample Data into 'player' Table
INSERT INTO player(first_name, last_name, username)
VALUES
('Patrick', 'Saint-Louis', 'sonic12345'),
('Marie', 'Jourdain', 'asterix2023'),
('Jonathan', 'David', 'pokemon527');

-- Insert Sample Data into 'authenticator' Table
INSERT INTO authenticator(password, player_id)
VALUES
('$2y$10$AMyb4cbGSWSvEcQxt91ZVu5r5OV7/3mMZl7tn8wnZrJ1ddidYfVYW', 1),
('$2y$10$Lpd3JsgFW9.x2ft6Qo9h..xmtm82lmSuv/vaQKs9xPJ4rhKlMJAF.', 2),
('$2y$10$FRAyAIK6.TYEEmbOHF4JfeiBCdWFHcqRTILM7nF/7CPjE3dNEWj3W', 3);

-- Insert Sample Data into 'score' Table
INSERT INTO score(result, lives_used, player_id)
VALUES
('win', 4, 1),
('gameover', 6, 2),
('incomplete', 5, 3);
