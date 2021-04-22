# Run within 10 s after running query_1

START TRANSACTION;

INSERT INTO `users` (`name`, `email`, `password`)
VALUES (SUBSTRING(MD5(RAND()) FROM 1 FOR 8), CONCAT(SUBSTRING(MD5(RAND()) FROM 1 FOR 8), '@test.com'), MD5(RAND()));

COMMIT;
