-- Database Name
CREATE DATABASE smarthome;

-- Tables start here 
-- 1st Table 
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2nd Table 
CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    room_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3rd Table 
CREATE TABLE devices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    room_id INT,
    device_name VARCHAR(100),
    device_type VARCHAR(50),
    status VARCHAR(10) DEFAULT 'OFF',
    speed VARCHAR(20),
    temperature INT,
    brightness INT NULL
);