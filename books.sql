CREATE TABLE Books
( ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Title CHAR(100) NOT NULL,
  Author CHAR(100) not null,
  ISBN CHAR(30) not null,
  Price FLOAT(6,2) not null,
  Date DATE NOT NULL
);