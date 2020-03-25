use snt8550;
drop table IF EXISTS SS_users;

CREATE TABLE SS_users (username VARCHAR(24) NOT NULL,
					   email VARCHAR(32),
					   password VARCHAR(24) NOT NULL,
					   joined DATETIME,
					   last_login DATETIME,
					   profile_picture VARCHAR(24),
					   PRIMARY KEY(username)) ENGINE=INNODB;
					   
