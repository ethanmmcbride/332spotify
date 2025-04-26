-- Create the database for artists
CREATE DATABASE IF NOT EXISTS music_project;
USE music_project;

-- Create songs table
CREATE TABLE IF NOT EXISTS `music_project`.`songs_normalize` (
    `artist` varchar(41),
    `song` varchar(114),
    `duration_ms` int(6),
    `explicit` varchar(5),
    `year` int(4),
    `popularity` int(2), 
    `danceability` decimal(4,3),
    `energy` decimal(5,4),
    `key` int(2), 
    `loudness` decimal(6,3),
    `mode` int(1), 
    `speechiness` decimal(5,4), 
    `acousticness` decimal(7,6),
    `instrumentalness` varchar(7), 
    `liveness` decimal(5,4),
    `valence` decimal(5,4),
    `tempo` decimal(6,3),
    `genre` varchar(37)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;;

-- Create artists table (with foreign key to artists)
CREATE TABLE IF NOT EXISTS `music_project`.`spotify_artist_data` (
    `SerialID` int(4),
    `Artist Name` varchar(45), 
    `Lead Streams` varchar(14),
    `Feats` varchar(14),
    `Tracks` varchar(6),
    `One Billion` int(2),
    `100 Million` int(3),
    `Last Updated` varchar(8)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;;
    
    
-- Create Users table     
CREATE TABLE IF NOT EXISTS `music_project`.`users` (
    `Username` varchar(19),
    `Password` varchar(12),
    `Preium_User` int(1)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;;