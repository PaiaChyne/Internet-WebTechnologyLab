CREATE DATABASE IF NOT EXISTS company_db;
USE company_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    department VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','employee') NOT NULL DEFAULT 'employee',
    status ENUM('pending','approved') NOT NULL DEFAULT 'pending'
);

/* If the users table already exists from before, run this instead: */
-- ALTER TABLE users ADD COLUMN status ENUM('pending','approved') NOT NULL DEFAULT 'pending';
-- UPDATE users SET status = 'approved' WHERE role = 'admin';
