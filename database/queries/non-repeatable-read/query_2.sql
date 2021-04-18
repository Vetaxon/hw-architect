# Run within 10 s after running query_1

START TRANSACTION;

UPDATE `users` SET `name` = SUBSTRING(MD5(RAND()) FROM 1 FOR 8) WHERE `id` = 1;

COMMIT;
