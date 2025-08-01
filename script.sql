create database secur_app;

use secur_app;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    content TEXT NOT NULL
);

INSERT INTO users (username, password) VALUES ('admin', 'password123');
INSERT INTO comments (article_id, content) VALUES (1, 'Premier commentaire !');