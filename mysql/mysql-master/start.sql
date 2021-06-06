GRANT REPLICATION SLAVE ON *.* TO 'slave-1'@'%' IDENTIFIED BY 'password';
GRANT REPLICATION SLAVE ON *.* TO 'slave-2'@'%' IDENTIFIED BY 'password';
FLUSH PRIVILEGES;

# SHOW MASTER STATUS;
SHOW PROCESSLIST;

DROP TABLE IF EXISTS `users`;

CREATE TABLE IF NOT EXISTS `users`
(
    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name`  varchar(240) DEFAULT ''
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  DEFAULT COLLATE utf8_unicode_ci;

DROP PROCEDURE IF EXISTS fill_data;
DELIMITER //

CREATE PROCEDURE fill_data()
BEGIN
    DECLARE var INT;
    SET var = 0;
    WHILE var < 100 DO
            INSERT INTO users (`name`) VALUES (CONCAT('name', var));
            SET var = var + 1;
        END WHILE;
END;

CALL fill_data();
