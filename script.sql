DROP DATABASE IF EXISTS eduexchange;

CREATE DATABASE eduexchange;

USE eduexchange;

CREATE TABLE logins (
    loginStatus BIT(1) NOT NULL,
    email VARCHAR(40) NOT NULL UNIQUE,
    pass CHAR(64) NOT NULL, 
    lastLogin DATE NOT NULL
);

CREATE TABLE users (
    firstname VARCHAR(20) NOT NULL, 
    lastname VARCHAR(20) NOT NULL, 
    email VARCHAR(40) NOT NULL UNIQUE, 
    phone VARCHAR(14) NOT NULL UNIQUE, 
    pass CHAR(64) NOT NULL, 
    avatar BLOB, 
    rating INTEGER,
    userID INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
    joined_date DATETIME NOT NULL,
    PRIMARY KEY (userID)
);

CREATE TABLE textbooks (
    textbook_id INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
    ibsn INTEGER, 
    cover BLOB NOT NULL, 
    title VARCHAR(20) NOT NULL, 
    description VARCHAR(20), 
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
    note_id INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
    cover BLOB NOT NULL, 
    title VARCHAR(20) NOT NULL, 
    description VARCHAR(20) NOT NULL, 
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
    supply_id INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
    cover BLOB NOT NULL, 
    title VARCHAR(20) NOT NULL, 
    description VARCHAR(20) NOT NULL, 
    upload_date DATETIME NOT NULL,
    viewDate DATETIME NOT NULL,
    uploader_id INTEGER NOT NULL,
    price INTEGER NOT NULL, 
    class VARCHAR(20) NOT NULL, 
    stat BIT(1) NOT NULL,
    PRIMARY KEY (title, uploader_id),
    CHECK (price > 0)
);