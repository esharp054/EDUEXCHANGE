DROP DATABASE IF EXISTS eduexchange

CREATE DATABASE eduexchange;

USE eduexchange;

CREATE TABLE users (
    firstname VARCHAR(20) NOT NULL, 
    lastname VARCHAR(20) NOT NULL, 
    email VARCHAR(40) NOT NULL, 
    phone VARCHAR(14) NOT NULL, 
    pass CHAR(64) NOT NULL, 
    avatar BLOB, 
    rating INTEGER,
    userID INTEGER NOT NULL UNIQUE,
    PRIMARY KEY (userID)
);

CREATE TABLE textbooks (
    ibsn INTEGER NOT NULL, 
    cover BLOB NOT NULL, 
    title VARCHAR(20) NOT NULL, 
    description VARCHAR(20), 
    upload_date DATE NOT NULL,
    uploader INTEGER NOT NULL,
    price INTEGER NOT NULL, 
    class VARCHAR(20) NOT NULL, 
    stat TINYINT NOT NULL,
    PRIMARY KEY (ibsn, uploader)
);

CREATE TABLE notes ( 
    cover BLOB NOT NULL, 
    title VARCHAR(20) NOT NULL, 
    description VARCHAR(20) NOT NULL, 
    upload_date DATE NOT NULL,
    uploader INTEGER NOT NULL,
    price INTEGER NOT NULL, 
    class VARCHAR(20) NOT NULL, 
    stat TINYINT NOT NULL,
    PRIMARY KEY (title, uploader)
);

CREATE TABLE supplies ( 
    cover BLOB NOT NULL, 
    title VARCHAR(20) NOT NULL, 
    description VARCHAR(20) NOT NULL, 
    upload_date DATE NOT NULL, 
    uploader INTEGER NOT NULL,
    price INTEGER NOT NULL, 
    class VARCHAR(20) NOT NULL, 
    stat TINYINT NOT NULL,
    PRIMARY KEY (title, uploader)
);