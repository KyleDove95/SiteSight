use snt8550;
drop table IF EXISTS users;
drop table IF EXISTS user_info;
drop table IF EXISTS tag;
drop table IF EXISTS tile;

CREATE TABLE users 
    (UID            VARCHAR(24) NOT NULL,
     joined         DATETIME,
     last_login     DATETIME,
     profile_pic    VARCHAR(24),
     PRIMARY KEY(UID)) ENGINE=INNODB;

CREATE TABLE user_info
    (email          VARCHAR(32),
     password       VARCHAR(24) NOT NULL,
    PRIMARY KEY(email)) ENGINE=INNODB;
    
CREATE TABLE tag
    (UID            VARCHAR(24) NOT NULL,
    tagname         VARCHAR(32),
    description     VARCHAR(32),
    time            DATETIME,
    PRIMARY KEY(UID, tagname)
    FOREIGN KEY(UID) REFERENCES users(UID) ON DELETE SET NULL) ENGINE=INNODB;
    
CREATE TABLE tile
    (tile_name      VARCHAR(24),
    UID             VARCHAR(24),
    tag_name        VARCHAR(32),
    description     VARCHAR(32),
    url             VARCHAR(32),
    time            DATETIME,
    PRIMARY KEY(tile_name, UID, tag_name)
    FOREIGN KEY(UID) REFERENCES users(UID) ON DELETE SET NULL)
    FOREIGN KEY(tag_name) REFERENCES tag(tag_name) ON DELETE SET NULL)) ENGINE=INNODB;
