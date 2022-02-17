<?php

namespace Tests\Feature\Models\Download\Pictures\Picture;

use App\Models\Download\Pictures\Picture\Picture;
use Tests\TestCase;

class PictureTest extends TestCase
{
    /**
     * @dataProvider providerSuccessCreate
     */
    public function testSuccessCreate(string $path, string $expected): void
    {
        $obj = new Picture($path);

        $this->assertInstanceOf(Picture::class, $obj);
        $this->assertEquals($expected, $obj->entryName);
    }

    /**
     * @return mixed[]
     */
    public function providerSuccessCreate(): array
    {
        return [
            ["image/1/obverse.ico", "1/obverse.ico"],
            ["image/2/reverse.png", "2/reverse.png"],
            ["/home/danshin/storage/image/2/reverse.png", "2/reverse.png"]
        ];
    }

    /**
     * @dataProvider providerWrongCreate
     */
    public function testWrongCreate(string $path): void
    {
        try {
            new Picture($path);
        } catch (\Exception $e) {
            $this->assertEquals("Short path '$path'. ", $e->getMessage());
        }
    }

    /**
     * @return mixed[]
     */
    public function providerWrongCreate(): array
    {
        return [
            ["image/obverse.ico"],
            ["obverse.ico"],
        ];
    }
}
