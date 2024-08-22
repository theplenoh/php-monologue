# php-monologue

A personal Twitter alternative written in PHP

## Create SQL tables
### Table `thoughts_entries`
```
CREATE TABLE thoughts_entries (
    entryID int(11) NOT NULL AUTO_INCREMENT, 
    content text NOT NULL, 
    wdate varchar(16) NOT NULL, 
    visibility int(1) NOT NULL, 
    pinned tinyint NOT NULL default 0, 
    PRIMARY KEY(entryID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
```
### Table `thoughts_auth`
```
CREATE TABLE thoughts_auth (
    userID int(11) NOT NULL AUTO_INCREMENT, 
    username varchar(50) NOT NULL UNIQUE, 
    password varchar(255) NOT NULL, 
    screenname varchar(50) NOT NULL, 
    PRIMARY KEY(userID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
```

## License
This repository is licensed under GPL v2.
