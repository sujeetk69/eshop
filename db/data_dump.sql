BEGIN;
CREATE DATABASE eshop;
CREATE TABLE eshop.products (id INT NOT NULL AUTO_INCREMENT, code VARCHAR(16) NOT NULL, name VARCHAR(255) NOT NULL, unit_price DOUBLE NOT NULL, PRIMARY KEY(id));
CREATE TABLE eshop.bundles (id INT NOT NULL AUTO_INCREMENT, product_id INT NOT NULL, bundle_size INT NOT NULL, bundle_price DOUBLE NOT NULL, PRIMARY KEY(id));
INSERT INTO eshop.products 
(id, 	code, 	name, 	unit_price) VALUES
(1, 	'ZA', 	'ZA', 	2.0), 
(2, 	'YB', 	'YB', 	12.0),
(3, 	'FC', 	'FC', 	1.25),
(4, 	'GD', 	'GD', 	0.15);
INSERT INTO eshop.bundles 
(id, 	product_id, 	bundle_size, 	bundle_price) VALUES
(NULL,	1, 				4,				7.0),
(NULL,	3, 				6,				6.0);
COMMIT;