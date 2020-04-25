-- Trigger
DELIMITER $$

CREATE TRIGGER my_first_tag
AFTER INSERT
ON SS_users FOR EACH ROW
BEGIN
    INSERT INTO SS_tags(userID, tag_name, description)
    VALUES(NEW.userID, 'My first tag!!', 'Welcome to Site Sight.  We hope you love it!!');
END$$

DELIMITER ;




-- View to implement stored function

-- viewSS_users
CREATE VIEW viewSS_users as 
SELECT *
FROM SS_users;

-- viewSS_tags
CREATE VIEW viewSS_tags AS
SELECT *
FROM SS_tags;




-- Stored Function
-- Called like 'SELECT userID, to_url(userID) FROM SS_users'
DROP FUNCTION to_url;

DELIMITER $$
CREATE FUNCTION to_url(space_str VARCHAR(32))
RETURNS VARCHAR(32) 
BEGIN 
	DECLARE newStr VARCHAR(32);
	SET newStr = REPLACE(space_str, ' ', '_');
	RETURN (newStr);
END$$
DELIMITER ;
