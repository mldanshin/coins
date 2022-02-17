<?php

namespace App\Models\Picture;

use App\Services\FileStorage;

abstract class RepositoryBase
{
    protected readonly string $directoryInside;
    protected readonly string $directoryOutside;
    protected readonly string $directoryInsideTemp;
    protected readonly string $directoryOutsideTemp;

    /**
     * @var string[] $extensions
     */
    protected readonly array $extensions;

    protected readonly string $default;

    public function __construct(
        public readonly FileStorage $storage
    ) {
        $this->directoryInside = "image/";
        $this->directoryInsideTemp = "image_temp/";
        $this->directoryOutside = "storage/image/";
        $this->directoryOutsideTemp = "storage/image_temp/";
        $this->extensions = config("app.picture_supported");
        $this->default = "default.svg";
    }

    public function exists(string $pathPart): bool
    {
        return $this->storage->exists($pathPart);
    }

    protected function getId(int $coinId, string $name): ?string
    {
        $pathPart = $this->createName($coinId, $name);

        foreach ($this->extensions as $extension) {
            $path = $pathPart . ".$extension";
            $res = $this->storage->exists($this->directoryInside . $path);
            if ($res === true) {
                return $path;
            }
        }

        return null;
    }

    protected function createName(int $coinId, string $name): string
    {
        return "$coinId/$name";
    }
}
