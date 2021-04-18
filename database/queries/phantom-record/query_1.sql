# SET autocommit=0;
# SET GLOBAL innodb_status_output=ON;
# SET GLOBAL innodb_status_output_locks=ON;
# SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;


# TRANSACTION ISOLATION LEVEL must REPEATABLE READ or lower
# run it before query_2

SELECT @@TX_ISOLATION;
SELECT @@autocommit;

START TRANSACTION;

SELECT COUNT(*) AS `count_first` FROM `users`;

DO SLEEP(10);


INSERT INTO `users` (`name`, `email`, `password`)
VALUES (SUBSTRING(MD5(RAND()) FROM 1 FOR 8), CONCAT(SUBSTRING(MD5(RAND()) FROM 1 FOR 8), '@test.com'), MD5(RAND()));

SELECT COUNT(*) AS `count_second` FROM `users`;

COMMIT;

# check results `count_first` and `count_second` withing one transaction
