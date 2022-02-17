<?php

namespace App\Models\CRUD\Picture;

use App\Models\Picture\Picture as PictureReader;
use App\Models\Picture\PictureType;
use App\Models\Picture\RepositoryBase;
use App\Models\CRUD\Picture\PictureUpload;
use App\Models\CRUD\Editor\Picture\Picture as PictureEditor;
use App\Models\CRUD\Editor\Picture\Source;
use App\Models\CRUD\Saving\Picture as PictureSaving;
use App\Models\CRUD\Updater\Picture as PictureUpdater;
use App\Services\FileStorage;

final class Repository extends RepositoryBase
{
    public function __construct(FileStorage $storage)
    {
        parent::__construct($storage);
    }

    public function getReader(int $coinId): PictureReader
    {
        $obverseId = $this->getId($coinId, "obverse");
        $reverseId = $this->getId($coinId, "reverse");

        return new PictureReader(
            $coinId,
            "picture coin",
            ($obverseId === null) ? null : $this->directoryOutside . $obverseId,
            ($reverseId === null) ? null : $this->directoryOutside . $reverseId,
            $this->directoryOutside . $this->default
        );
    }

    public function getEditor(int $coinId): PictureEditor
    {
        $obverseId = $this->getId($coinId, "obverse");
        $reverseId = $this->getId($coinId, "reverse");

        return new PictureEditor(
            $coinId,
            ($obverseId === null) ? null : new Source(
                $this->directoryInside . $obverseId,
                $this->directoryOutside . $obverseId,
                PictureType::obverse
            ),
            ($reverseId === null) ? null : new Source(
                $this->directoryInside . $reverseId,
                $this->directoryOutside . $reverseId,
                PictureType::reverse
            )
        );
    }

    /**
     * @throws \Exception
     */
    public function upload(PictureUpload $picture): Source
    {
        $fileName = $this->storage->putFile($this->directoryInsideTemp, $picture->file);

        if (!$this->storage->exists($this->directoryInsideTemp . $fileName)) {
            throw new \Exception("File not found. ");
        }

        return new Source(
            $this->directoryInsideTemp . $fileName,
            $this->directoryOutsideTemp . $fileName,
            $picture->type
        );
    }

    public function store(int $coinId, PictureSaving $picture): void
    {
        $this->createDirectory($coinId);

        $this->updateElement($coinId, $picture->obverse, "obverse");
        $this->updateElement($coinId, $picture->reverse, "reverse");
    }

    public function update(PictureUpdater $picture): void
    {
        $this->updateElement($picture->coinId, $picture->obverse, "obverse");
        $this->updateElement($picture->coinId, $picture->reverse, "reverse");
    }

    public function delete(int $coinId): void
    {
        $this->storage->deleteDirectory($this->directoryInside . $coinId);
    }

    private function createDirectory(int $coinId): void
    {
        $this->storage->createDirectory($this->directoryInside . $coinId);
    }

    private function deleteByName(string $name): void
    {
        foreach ($this->extensions as $extension) {
            $path = $name . ".$extension";
            $res = $this->storage->exists($this->directoryInside . $path);
            if ($res === true) {
                $this->storage->delete($this->directoryInside . $path);
            }
        }
    }

    private function getDirectoryType(string $partPath): string
    {
        $array = explode("/", $partPath);
        return $array[0] . "/";
    }

    private function getExtension(string $partPath): string
    {
        $array = explode("/", $partPath);
        $array = explode(".", $array[count($array) - 1]);
        return $array[count($array) - 1];
    }

    private function moveTemp(string $pathTemp, string $name): void
    {
        $this->deleteByName($name);
        $this->storage->move(
            $pathTemp,
            $this->directoryInside . "$name." . $this->getExtension($pathTemp)
        );
    }

    private function updateElement(int $coinId, ?string $partPath, string $type): void
    {
        $name = $this->createName($coinId, $type);

        if ($partPath === null) {
            $this->deleteByName($name);
        } elseif ($this->getDirectoryType($partPath) === $this->directoryInsideTemp) {
            $this->moveTemp($partPath, $name);
        }
    }
}
