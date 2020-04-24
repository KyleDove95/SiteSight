use snt8550;
drop table IF EXISTS SS_tiles;
drop table IF EXISTS SS_tags;
drop table IF EXISTS SS_users;

CREATE TABLE SS_users
    (userID      VARCHAR(24) NOT NULL,
	email        VARCHAR(32) NOT NULL,
	password     VARCHAR(64) NOT NULL,
    joined       DATETIME default CURRENT_TIMESTAMP,
    last_login   DATETIME default CURRENT_TIMESTAMP,
    profile_pic  VARCHAR(24) default NULL,
	is_admin     INT default '0' NOT NULL,
    PRIMARY KEY (userID)) ENGINE=INNODB;

CREATE TABLE SS_tags
    (userID       VARCHAR(24) NOT NULL,
	tag_name      VARCHAR(32) NOT NULL,
    description   VARCHAR(128),
    time_created  DATETIME default CURRENT_TIMESTAMP,
    PRIMARY KEY (userID, tag_name),
    FOREIGN KEY (userID) 
		REFERENCES SS_users(userID)
		ON DELETE CASCADE
	) ENGINE=INNODB;

ALTER TABLE `SS_tags` ADD INDEX(`tag_name`);

CREATE TABLE SS_tiles
    (userID       VARCHAR(24) NOT NULL,
    tag_name      VARCHAR(32) NOT NULL,
    tile_name     VARCHAR(32) NOT NULL,
    description   VARCHAR(128),
    url           VARCHAR(64) NOT NULL,
    time_created  DATETIME default CURRENT_TIMESTAMP,
    PRIMARY KEY (userID, tag_name, tile_name),
    FOREIGN KEY (userID) 
		REFERENCES SS_users(userID)
		ON DELETE CASCADE,
	FOREIGN KEY (tag_name) 
		REFERENCES SS_tags(tag_name)
		ON DELETE CASCADE
	) ENGINE=INNODB;
