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
    FOREIGN KEY (player_id) REFERENCES player(player_id) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Optional: Create a Table for User Settings or Roles
CREATE TABLE IF NOT EXISTS user_settings (
    setting_id INT AUTO_INCREMENT PRIMARY KEY,
    player_id INT NOT NULL,
    setting_name VARCHAR(50) NOT NULL,
    setting_value VARCHAR(100) NOT NULL,
    FOREIGN KEY (player_id) REFERENCES player(player_id) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
