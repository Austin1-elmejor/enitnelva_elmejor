-- FILE: database.sql
CREATE DATABASE IF NOT EXISTS valentine_db;
USE valentine_db;

CREATE TABLE IF NOT EXISTS cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    unique_id VARCHAR(50) NOT NULL,
    sender_name VARCHAR(100),
    partner_name VARCHAR(100),
    sender_email VARCHAR(100),
    status VARCHAR(20) DEFAULT 'Waiting',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);