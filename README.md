# php-monologue

A personal Twitter alternative written in PHP

An SQL query to create a table for `php-monologue`:  
```
CREATE TABLE monologue_entries (
    entryID int(11) NOT NULL AUTO_INCREMENT, 
    content text NOT NULL, 
    wdate varchar(16) NOT NULL, 
    visibility int(1) NOT NULL, 
    PRIMARY KEY(entryID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
```

## License
This repository is licensed under GPL v2.
