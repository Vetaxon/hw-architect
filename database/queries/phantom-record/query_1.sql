# SET autocommit=0;
# SET GLOBAL innodb_status_output=ON;
# SET GLOBAL innodb_status_output_locks=ON;
# SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;


# TRANSACTION ISOLATION LEVEL must REPEATABLE READ or lower
# run it before query_2

SELECT @@TX_ISOLATION;

START TRANSACTION;

SELECT COUNT(*) AS `count_first` FROM `users`;

DO SLEEP(10);

SELECT COUNT(*) AS `count_second` FROM `users`;

COMMIT;

# check results `count_first` and `count_second` withing one transaction
