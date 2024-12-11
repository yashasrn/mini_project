-- Create the 'research_centre' database if not exists
CREATE DATABASE IF NOT EXISTS research_centre;

-- Use the 'research_centre' database
USE research_centre;

-- Create the 'doctorates' table
CREATE TABLE IF NOT EXISTS doctorates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL
);

-- Create the 'users' table for authentication
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL -- For secure password storage, use hashing (e.g., bcrypt) in your application code.
);


-- Insert a default admin user
INSERT INTO users (username, password)
VALUES ('admin', MD5('admin123'))
ON DUPLICATE KEY UPDATE password = MD5('admin123');


-- Create the 'supervisors' table
CREATE TABLE IF NOT EXISTS supervisors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    usn VARCHAR(20) NOT NULL UNIQUE,
    guide VARCHAR(255) NOT NULL
);

-- Create the 'advisory_committee' table
CREATE TABLE IF NOT EXISTS advisory_committee (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    post VARCHAR(255) NOT NULL
);

-- Create the 'publications' table
CREATE TABLE IF NOT EXISTS publications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    publication_date DATE NOT NULL
);

-- Create the 'books' table
CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teacher_name VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    national_international ENUM('National', 'International') NOT NULL,
    year YEAR NOT NULL,
    isbn VARCHAR(50) NOT NULL UNIQUE,
    publisher VARCHAR(255) NOT NULL
);

-- Create the 'book_chapters' table
CREATE TABLE IF NOT EXISTS book_chapters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teacher_name VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    national_international ENUM('National', 'International') NOT NULL,
    year YEAR NOT NULL,
    isbn VARCHAR(50) NOT NULL UNIQUE,
    publisher VARCHAR(255) NOT NULL
);

-- Create the 'patents' table
CREATE TABLE IF NOT EXISTS patents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teacher_name VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    application_no VARCHAR(100) NOT NULL UNIQUE,
    year YEAR NOT NULL,
    status VARCHAR(100) NOT NULL,
    type ENUM('published', 'granted') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create the 'grants' table
CREATE TABLE IF NOT EXISTS grants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(255) NOT NULL,
    principal_investigator VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    year_of_award YEAR NOT NULL,
    amount_sanctioned FLOAT NOT NULL,
    duration VARCHAR(50) NOT NULL,
    funding_agency VARCHAR(255) NOT NULL,
    type ENUM('faculty', 'student') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create the 'student_grants' table
CREATE TABLE IF NOT EXISTS student_grants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(255) NOT NULL,
    student_name VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    year_of_award YEAR NOT NULL,
    amount_sanctioned FLOAT NOT NULL,
    duration VARCHAR(50) NOT NULL,
    funding_agency VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Create the 'conferences' table
CREATE TABLE IF NOT EXISTS conferences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    national_international ENUM('National', 'International') NOT NULL,
    year_of_publication YEAR NOT NULL,
    details TEXT NOT NULL
);

-- Create the 'journals' table
CREATE TABLE IF NOT EXISTS journals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    journal_title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    publisher VARCHAR(255) NOT NULL,
    year_of_publication YEAR NOT NULL,
    issn_number VARCHAR(20) NOT NULL UNIQUE
);
