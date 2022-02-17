<?php

namespace App\Console\Commands;

use App\Services\FileStorage;
use App\Support\Storage;
use Illuminate\Console\Command;

class StorageMake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating directories in the storage';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        (new Storage(FileStorage::instance()))->createDirectoryIfNotExists();
        $this->info("The command 'storage:make' was executed successfully");

        return 0;
    }
}
