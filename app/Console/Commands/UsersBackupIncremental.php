<?php

namespace App\Console\Commands;

class UsersBackupIncremental extends UsersBackup
{
    protected const DEFAULT_DAY_INTERVAL = 1;

    protected const FLAG_NO_CREATE = '-t';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:backup:incremental';

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return storage_path(sprintf(
                'backup/backup-users-incremental-%s-%s.sql',
                date('Y-m-d_H:i:s', strtotime(sprintf(' - %s day', $this->getDayInterval()))),
                date('Y-m-d_H:i:s'))
        );
    }

    /**
     * @return string
     */
    protected function getCondition(): string
    {
        return sprintf(
            "--where='updated_at > DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL %s DAY) AND updated_at <= CURRENT_TIMESTAMP()'",
            $this->getDayInterval()
        );
    }

    /**
     * @return int
     */
    protected function getDayInterval(): int
    {
        return static::DEFAULT_DAY_INTERVAL;
    }

    /**
     * @return string
     */
    protected function getAdditionalFlags(): string
    {
        return static::FLAG_NO_CREATE;
    }
}
