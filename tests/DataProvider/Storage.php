<?php
namespace Tests\DataProvider;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage as StorageFacade;

trait Storage
{
    private function seedStorage(?Filesystem $disk = null): void
    {
        if ($disk === null) {
            $disk = StorageFacade::fake("public");
        }

        File::copyDirectory(
            storage_path("app/public_fake"),
            $disk->path("")
        );
    }

    private function cleanStorage(?Filesystem $disk = null): void
    {
        if ($disk === null) {
            $disk = StorageFacade::fake("public");
        }
        $this->seedStorage($disk);
        File::cleanDirectory($disk->path("image"));
        File::cleanDirectory($disk->path("image_temp"));
        File::cleanDirectory($disk->path("download"));
    }

    private function getPathFile(): string
    {
        return storage_path("app/public_fake/image/default.svg");
    }

    private function setConfigFakeDisk(): void
    {
        config(["filesystems.disks.public.root" => storage_path('framework/testing/disks/public')]);
    }
}
