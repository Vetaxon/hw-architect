<?php

namespace App\Console\Commands;

class UsersBackupDifferential extends UsersBackupIncremental
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:backup:differential';

    /**
     * @return int
     */
    protected function getDayInterval(): int
    {
        return date('N', strtotime('now'));
    }
}
