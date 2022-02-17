<?php

namespace App\Console\Commands;

use App\Services\FileStorage;
use App\Support\PictureRepository;
use Illuminate\Console\Command;

class PictureSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'picture:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills the storage with demo images';

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
        if ($this->confirm('Executing the delete all your images command, continue?')) {
            (new PictureRepository(FileStorage::instance()))->seed();
            $this->info("The command 'picture:seed' was executed successfully");
        }
        return 0;
    }
}
