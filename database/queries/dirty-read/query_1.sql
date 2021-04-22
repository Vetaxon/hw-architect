# SET autocommit=0;
# SET GLOBAL innodb_status_output=ON;
# SET GLOBAL innodb_status_output_locks=ON;
# SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;


# TRANSACTION ISOLATION LEVEL must READ UNCOMMITTED
# run it before query_2

SELECT `name` AS `name_first` FROM `users` WHERE `id` = 1;

SELECT @@TX_ISOLATION;
SELECT @@autocommit;

START TRANSACTION;

UPDATE `users` SET `name` = SUBSTRING(MD5(RAND()) FROM 1 FOR 8) WHERE `id` = 1;

DO SLEEP(10);

ROLLBACK;

SELECT `name` AS `name_second` FROM `users` WHERE `id` = 1;

# see the same results `name_first` and `name_second`
