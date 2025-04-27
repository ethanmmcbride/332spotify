--Adds primary key to artist table
ALTER TABLE spotify_artist_data ADD artist_id VARCHAR (255);
UPDATE spotify_artist_data
SET artist_id =REPLACE(TRIM(`Artist Name`),' ','_');
ALTER TABLE spotify_artist_data ADD PRIMARY KEY (artist_id);

--Add primary key to song table
ALTER TABLE songs_normalize ADD track_id VARCHAR (24);
UPDATE songs_normalize
SET track_id = LEFT(UUID(),24);
ALTER TABLE songs_normalize ADD PRIMARY KEY (track_id);

--Link artist and song tables
ALTER TABLE songs_normalize ADD artist_id VARCHAR (255);
UPDATE songs_normalize
SET artist_id = (SELECT artist_id FROM spotify_artist_data WHERE spotify_artist_data.`Artist Name` = songs_normalize.artist);
DELETE FROM songs_normalize where artist_id is NULL;
ALTER TABLE songs_normalize ADD CONSTRAINT fk_artist
FOREIGN KEY (artist_id) REFERENCES spotify_artist_data(artist_id);

--assigns primary key to Users
ALTER TABLE users ADD PRIMARY KEY (username);

--randomly assign users to the songs table to show last played by
ALTER TABLE songs_normalize  ADD COLUMN last_played_by VARCHAR(225);
UPDATE songs_normalize
SET last_played_by = (
    SELECT username
    FROM users
    ORDER BY RAND()
    LIMIT 1
);

