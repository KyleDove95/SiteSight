-- Trigger
CREATE TRIGGER user_check 
BEFORE INSERT ON SS_users
FOR EACH ROW
BEGIN
    IF(EXISTS(SELECT 1 FROM SS_users WHERE userID = NEW.userID)) THEN SIGNAL SQLSTATE VALUE '45000' SET MESSAGE_TEXT = 'INSERT failed due to duplicate user id';
    END IF;
END$$
DELIMITER;




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
-- Called like 'SELECT to_url(viewSS_users, userID) FROM SS_users'  OR  'SELECT to_url(SS_tags, tag_name) FROM SS_tags';
CREATE FUNCTION to_url (
	view_name VARCHAR(16),		-- either "viewSS_users" or "viewSS_tags" in function call
	space_str VARCHAR(32)		-- either "userID" or "tag_name" in function call
)
RETURNS VARCHAR(32)
BEGIN
	DECLARE newStr VARCHAR(32);
	
	IF (view_name == "SS_users" OR view_name == "SS_tags") THEN
		SET newStr = REPLACE(space_str, ' ', '_');
	
	END IF;
	
	RETURN (newStr);

END
Delimiter ;