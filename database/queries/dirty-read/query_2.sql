# Run within 10 s after running query_1

START TRANSACTION;

SELECT `name` AS `name_middle` FROM `users` WHERE `id` = 1;

COMMIT;
