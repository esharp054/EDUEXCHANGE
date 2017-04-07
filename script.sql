DROP DATABASE IF EXISTS eduexchange

CREATE DATABASE eduexchange

USE eduexchange

CREATE TABLE users (
    first VARCHAR(20), 
    last VARCHAR(20), 
    email VARCHAR(40), 
    phone VARCHAR(14), 
    pass CHAR(64), 
    avatar IMAGE BLOB, 
    rating INTEGER,
    userID INTEGER
);

CREATE TABLE textbooks (
    ibsn INTEGER, 
    cover IMAGE BLOB, 
    title VARCHAR(20), 
    description VARCHAR(20), 
    upload_date DATE,
    uploader INTEGER,
    price INTEGER, 
    class VARCHAR(20), 
    stat TINYINT
);

CREATE TABLE notes ( 
    cover IMAGE BLOB, 
    title VARCHAR(20), 
    description VARCHAR(20), 
    upload_date DATE,
    uploader INTEGER,
    price INTEGER, 
    class VARCHAR(20), 
    stat TINYINT
);

CREATE TABLE supplies ( 
    cover IMAGE BLOB, 
    title VARCHAR(20), 
    description VARCHAR(20), 
    upload_date DATE, 
    uploader INTEGER,
    price INTEGER, 
    class VARCHAR(20), 
    stat TINYINT
);