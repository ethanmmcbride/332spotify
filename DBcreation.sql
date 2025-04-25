-- Create the database for artists
CREATE DATABASE IF NOT EXISTS music_project;
USE music_project;

-- Create artists table
CREATE TABLE IF NOT EXISTS artists (
    artist_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    genre VARCHAR(50) NOT NULL
);

-- Create songs table (with foreign key to artists)
CREATE TABLE IF NOT EXISTS songs (
    song_id INT AUTO_INCREMENT PRIMARY KEY,
    album_name VARCHAR(100) NOT NULL,
    song_duration TIME NOT NULL,
    explicit BOOLEAN NOT NULL DEFAULT FALSE,
    artist_id INT NOT NULL,
    FOREIGN KEY (artist_id) REFERENCES artists(artist_id)
);