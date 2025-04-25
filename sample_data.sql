-- Insert sample artists
INSERT INTO artists (name, genre) VALUES 
('The Beatles', 'Rock'),
('Taylor Swift', 'Pop'),
('Kendrick Lamar', 'Hip Hop'),
('Miles Davis', 'Jazz');

-- Insert sample songs
INSERT INTO songs (album_name, song_duration, explicit, artist_id) VALUES
('Abbey Road', '00:03:25', FALSE, 1),
('Red', '00:03:43', FALSE, 2),
('To Pimp a Butterfly', '00:05:28', TRUE, 3),
('Kind of Blue', '00:09:22', FALSE, 4),
('Let It Be', '00:03:50', FALSE, 1),
('1989', '00:03:51', FALSE, 2);