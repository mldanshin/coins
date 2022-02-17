<?php

namespace App\Console\Commands;

use App\Services\FileStorage;
use App\Support\PictureRepository;
use Illuminate\Console\Command;

class PictureTempClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'picture:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes old temporary files';

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
        (new PictureRepository(FileStorage::instance()))->clearTemp();
        $this->info("The command 'picture:clear' was executed successfully");

        return 0;
    }
}
