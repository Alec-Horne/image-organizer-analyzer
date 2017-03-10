USE ISP_ajh158;
CREATE TABLE accounts
(
	ID MEDIUMINT NOT NULL AUTO_INCREMENT,
	first_name NVARCHAR(50) NULL,
	last_name NVARCHAR(50) NULL,
	email NVARCHAR(50) NULL,
    login NVARCHAR(50) NULL,
    password NVARCHAR(50) NULL,
    PRIMARY KEY (ID)
);

INSERT INTO accounts (first_name, last_name, email, login, password) 
VALUES ('Alec', 'Horne', 'ajh158@zips.uakron.edu', 'ajh158', 'ecfmqpts69');