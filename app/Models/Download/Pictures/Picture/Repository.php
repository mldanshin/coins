<?php

namespace App\Models\Download\Pictures\Picture;

use App\Models\Picture\RepositoryBase;
use App\Services\FileStorage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

final class Repository extends RepositoryBase
{
    public function __construct(FileStorage $storage)
    {
        parent::__construct($storage);
    }

    /**
     * @return Collection<Picture>
     */
    public function getCollection(): Collection
    {
        $collection = [];

        $files = $this->getFiles();
        foreach ($files as $file) {
            $collection[] = new Picture($file);
        }

        return collect($collection);
    }

    /**
     * @return string[]
     */
    private function getFiles(): array
    {
        $files = [];

        $filesInfo = File::allFiles($this->storage->buildPath($this->directoryInside));
        foreach ($filesInfo as $item) {
            if ($item->getFileName() !== $this->default) {
                $files[] = $item->getPathName();
            }
        }

        return $files;
    }
}
