<?php


namespace App\Console\Commands;


class UsersBackupDay extends UsersBackupIncremental
{
    protected const COMMAND_IMPORT = 'mysqldump -h%s -p%s -u%s -p%s %s %s < %s';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:backup:delta';

    /**
     * @var string
     */
    protected $importCommand;

    public function __construct()
    {
        parent::__construct();

        $this->importCommand = sprintf(
            static::COMMAND_IMPORT,
            config('database.connections.mysql.host'),
            config('database.connections.mysql.port'),
            config('database.connections.mysql.root_user'),
            config('database.connections.mysql.root_password'),
            config('database.connections.mysql.database'),
            $this->getTable(),
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
        parent::handle();

        try {
            $this->info('Running: ' . $this->importCommand);
            exec($this->importCommand);
            $this->info('The backup has been imported successfully.');
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
        return storage_path('backup/backup-users-daily.sql');
    }

}
