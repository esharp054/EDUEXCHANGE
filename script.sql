DROP DATABASE IF EXISTS eduexchange;

CREATE DATABASE eduexchange;

USE eduexchange;

CREATE TABLE users ( 
    email VARCHAR(40) NOT NULL UNIQUE, 
    phone VARCHAR(11) NOT NULL UNIQUE, 
    pass CHAR(64) NOT NULL, 
    avatar TEXT, 
    rating INTEGER,
    userID INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
    joined_date DATETIME NOT NULL,
    username VARCHAR(40) UNIQUE NOT NULL,
    PRIMARY KEY (userID)
);

CREATE TABLE textbooks (
    id INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
    ibsn INTEGER, 
    cover TEXT NOT NULL, 
    title VARCHAR(40) NOT NULL, 
    description VARCHAR(200), 
    upload_date DATETIME NOT NULL,
    viewDate DATETIME NOT NULL,
    uploader_id INTEGER NOT NULL,
    price INTEGER NOT NULL, 
    class VARCHAR(20) NOT NULL, 
    stat BIT(1) NOT NULL,
    PRIMARY KEY (ibsn, uploader_id),
    CHECK (ibsn > 0),
    CHECK (price > 0)
);

CREATE TABLE notes ( 
    id INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
    type VARCHAR(20) NOT NULL DEFAULT 'notes',
    cover TEXT NULL, 
    title VARCHAR(40) NOT NULL, 
    description VARCHAR(200) NOT NULL, 
    upload_date DATETIME NOT NULL,
    viewDate DATETIME NOT NULL,
    uploader_id INTEGER NOT NULL,
    price INTEGER NOT NULL, 
    class VARCHAR(20) NOT NULL, 
    stat BIT(1) NOT NULL,
    PRIMARY KEY (title, uploader_id),
    CHECK (price > 0)
);

CREATE TABLE supplies ( 
    id INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
    type VARCHAR(20) NOT NULL DEFAULT 'supplies',
    cover TEXT NOT NULL, 
    title VARCHAR(40) NOT NULL, 
    description VARCHAR(200) NOT NULL, 
    upload_date DATETIME NOT NULL,
    viewDate DATETIME NOT NULL,
    uploader_id INTEGER NOT NULL,
    price INTEGER NOT NULL, 
    class VARCHAR(20) NOT NULL, 
    stat BIT(1) NOT NULL,
    PRIMARY KEY (title, uploader_id),
    CHECK (price > 0)
);