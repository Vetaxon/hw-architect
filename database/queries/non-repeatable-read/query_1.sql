# SET autocommit=0;
# SET GLOBAL innodb_status_output=ON;
# SET GLOBAL innodb_status_output_locks=ON;
# SET TRANSACTION ISOLATION LEVEL READ COMMITTED;


# TRANSACTION ISOLATION LEVEL must READ COMMITTED or lower
# run it before query_2

SELECT @@TX_ISOLATION;

START TRANSACTION;

SELECT `name` AS `name_first` FROM `users` WHERE `id` = 1;
# SELECT `name` AS `name_first` FROM `users` WHERE `id` = 1 FOR UPDATE;

DO SLEEP(10);

SELECT `name` AS `name_second` FROM `users` WHERE `id` = 1;

COMMIT;

# check results `name_first` and `name_second` withing one transaction
