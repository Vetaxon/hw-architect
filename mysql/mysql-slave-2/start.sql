#  STOP SLAVE;
# CHANGE MASTER TO MASTER_HOST='mysql-master',
#     MASTER_USER='slave-2', MASTER_PASSWORD='password',
#     MASTER_LOG_FILE = 'mysql-bin.000002', MASTER_LOG_POS = 3;
# START SLAVE;
# SHOW SLAVE STATUS;
