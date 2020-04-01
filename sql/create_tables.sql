use snt8550;
drop table IF EXISTS SS_users;
drop table IF EXISTS SS_user_info;
drop table IF EXISTS SS_tag;
drop table IF EXISTS SS_tile;

CREATE TABLE SS_users 
    (UID            VARCHAR(24) NOT NULL,
    joined          DATETIME default CURRENT_TIMESTAMP,
    last_login      DATETIME default CURRENT_TIMESTAMP,
    profile_pic     VARCHAR(24),
    PRIMARY KEY(UID)) ENGINE=INNODB;

CREATE TABLE SS_user_info
    (email          VARCHAR(32) NOT NULL,
    password        VARCHAR(64) NOT NULL,
    PRIMARY KEY(email)) ENGINE=INNODB;
    
CREATE TABLE SS_tag
    (UID            VARCHAR(24) NOT NULL,
    tagname         VARCHAR(32) NOT NULL,
    description     VARCHAR(64),
    time            DATETIME default CURRENT_TIMESTAMP,
    PRIMARY KEY(UID, tagname)
    FOREIGN KEY(UID) REFERENCES users(UID) ON DELETE SET NULL) ENGINE=INNODB;
    
CREATE TABLE SS_tile
    (tile_name      VARCHAR(24) NOT NULL,
    UID             VARCHAR(24) NOT NULL,
    tag_name        VARCHAR(32) NOT NULL,
    description     VARCHAR(64),
    url             VARCHAR(32) NOT NULL,
    time            DATETIME default CURRENT_TIMESTAMP,
    PRIMARY KEY(tile_name, UID, tag_name)
    FOREIGN KEY(UID) REFERENCES users(UID) ON DELETE SET NULL)
    FOREIGN KEY(tag_name) REFERENCES tag(tag_name) ON DELETE SET NULL)) ENGINE=INNODB;