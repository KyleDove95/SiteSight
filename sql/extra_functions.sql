-- Trigger
DROP TRIGGER IF EXISTS my_first_tag;
DELIMITER $$

CREATE TRIGGER my_first_tag
AFTER INSERT
ON SS_users FOR EACH ROW
BEGIN
    INSERT INTO SS_tags(userID, tag_name, description)
    VALUES(NEW.userID, 'My first tag!!', 'Welcome to Site Sight.  We hope you love it!!');
END$$

DELIMITER ;



-- viewSS_users
DROP VIEW IF EXISTS viewSS_users;
CREATE VIEW viewSS_users as 
SELECT userID AS 'Username', email AS 'Email', password AS 'Hashed Password', joined AS 'Joined On', last_login AS 'Last Login', profile_pic AS 'Profile Filename', is_admin AS 'Admin Status'
FROM SS_users;

-- viewSS_tags
DROP VIEW IF EXISTS viewSS_tags;
CREATE VIEW viewSS_tags AS
SELECT userID AS 'Username', tag_name AS 'Tag Name', description AS 'Description', time_created AS 'Created On'
FROM SS_tags;



-- Stored Function
-- Called like 'SELECT userID, to_url(userID) FROM SS_users'
DROP FUNCTION IF EXISTS to_url;

DELIMITER $$
CREATE FUNCTION to_url(space_str VARCHAR(32))
RETURNS VARCHAR(32) 
BEGIN 
	DECLARE newStr VARCHAR(32);
	SET newStr = REPLACE(space_str, ' ', '_');
	RETURN (newStr);
END$$
DELIMITER ;


