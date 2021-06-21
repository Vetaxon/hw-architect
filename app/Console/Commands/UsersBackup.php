<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UsersBackup extends Command
{
    protected const COMMAND = 'mysqldump -h%s -p%s -u%s -p%s %s %s %s %s> %s';

    protected const USERS_TABLE = 'users';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:backup:full';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var string
     */
    protected $command;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->command = sprintf(
            static::COMMAND,
            config('database.connections.mysql.host'),
            config('database.connections.mysql.port'),
            config('database.connections.mysql.root_user'),
            config('database.connections.mysql.root_password'),
            config('database.connections.mysql.database'),
            $this->getTable(),
            $this->getCondition(),
            $this->getAdditionalFlags(),
            $this->getPath()
        );
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            $this->info('Running: ' . $this->command);
            exec($this->command);
            $this->info('The backup has been proceed successfully.');
            return 0;
        } catch (\Throwable $throwable) {
            $this->error('The backup process has been failed. ' . $throwable->getMessage());
            return $throwable->getCode();
        }
    }

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return storage_path(sprintf('backup/backup-users-full-%s.sql', date('Y-m-d')));
    }

    /**
     * @return string
     */
    protected function getTable(): string
    {
        return static::USERS_TABLE;
    }

    /**
     * @return string
     */
    protected function getCondition(): string
    {
        return '';
    }

    /**
     * @return string
     */
    protected function getAdditionalFlags(): string
    {
        return '';
    }
}
