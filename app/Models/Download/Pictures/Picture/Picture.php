<?php

namespace App\Models\Download\Pictures\Picture;

final class Picture
{
    public readonly string $entryName;

    public function __construct(
        public readonly string $path
    ) {
        $this->entryName = $this->getEntryName();
    }

    /**
     * @throws \Exception
     */
    private function getEntryName(): string
    {
        $array = explode("/", $this->path);

        $countArray = count($array);
        if ($countArray < 3) {
            throw new \Exception("Short path '$this->path'. ");
        }

        return $array[$countArray - 2] . "/" . $array[$countArray - 1];
    }
}
