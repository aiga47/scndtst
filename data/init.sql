CREATE DATABASE test;

use test;

CREATE TABLE products (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	sku VARCHAR(40) NOT NULL,
	name VARCHAR(30) NOT NULL,
	price INT(20) NOT NULL,
	productType VARCHAR(30) NOT NULL,
	size INT(20),
	weight INT(20),
	height INT(20),
	width INT(20),
	length INT(20),
	date TIMESTAMP
);
