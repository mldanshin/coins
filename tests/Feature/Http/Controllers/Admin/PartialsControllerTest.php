<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Tests\DataProvider\User as UserDataProvider;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;

class PartialsControllerTest extends TestCase
{
    use DatabaseMigrations;
    use StorageDataProvider;
    use UserDataProvider;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->setConfigFakeDisk();
        $this->seedStorage();
    }

    /**
     * @dataProvider providerUploadPictureSuccess
     * @param mixed[] $data
     */
    public function testUploadPictureSuccess(array $data): void
    {
        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->post(route("admin.partials.upload_picture"), $data);
        $response->assertStatus(200);
    }

    /**
     * @return mixed[]
     */
    public function providerUploadPictureSuccess(): array
    {
        return [
            [
                [
                    "picture-obverse-file" => UploadedFile::fake()->create('avatar.jpg', 100)
                ],
                [
                    "picture-reverse-file" => UploadedFile::fake()->create('avatar.jpg', 100)
                ]
            ]
        ];
    }

    /**
     * @dataProvider providerUploadPictureWrong
     * @param mixed[] $data
     */
    public function testUploadPictureWrong(array $data): void
    {
        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->post(route("admin.partials.upload_picture"), $data);
        //dump(session("errors")->getMessages());
        $response->assertStatus(302);
    }

    /**
     * @return mixed[]
     */
    public function providerUploadPictureWrong(): array
    {
        return [
            [
                [
                    
                ],
            ],
            [
                [
                    "picture-obverse-file" => "",
                    "picture-reverse-file" => "",
                ],
            ],
            [
                [
                    "picture-obverse-file" => "blabla.jpg",
                ],
            ],
            [
                [
                    "picture-obverse-file" => "blabla.jpg",
                    "picture-reverse-file" => "blabla.png",
                ],
            ],
            [
                [
                    "picture-obverse-file" => UploadedFile::fake()->create('obverse.jpg', 100),
                    "picture-reverse-file" => UploadedFile::fake()->create('reverse.jpg', 100),
                ],
            ],
            [
                [
                    "picture-obverse-file" => UploadedFile::fake()->create('obverse.jjpg', 100),
                ],
            ]
        ];
    }
}
