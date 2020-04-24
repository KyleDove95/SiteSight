-- Trigger
create trigger url_userID
before INSERT
on SS_users
... -- more needed




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
	view_name VARCHAR(8),		-- either "viewSS_users" or "viewSS_tags" in function call
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





