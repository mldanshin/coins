<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\DataProvider\Storage as StorageDataProvider;
use Tests\DataProvider\User as UserDataProvider;

class DownloadControllerTest extends TestCase
{
    use DatabaseMigrations;
    use StorageDataProvider;
    use UserDataProvider;

    /**
     * @dataProvider providerDownloadDocumentSuccess
     */
    public function testDownloadDocumentSuccess(string $type, ?string $coinId): void
    {
        $this->seed();
        $this->seedStorage();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->get(route("download.document", [$type, $coinId]));
        $response->assertDownload();
    }

    /**
     * @return mixed[]
     */
    public function providerDownloadDocumentSuccess(): array
    {
        return [
            ["pdf", "1"],
            ["pdf", "5"],
            ["pdf", null]
        ];
    }

    /**
     * @dataProvider providerDownloadDocumentWrong
     */
    public function testDownloadDocumentWrong(string $type, ?string $coinId): void
    {
        $this->seed();
        $this->seedStorage();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->get(route("download.document", [$type, $coinId]));
        $response->assertStatus(404);
    }

    /**
     * @return mixed[]
     */
    public function providerDownloadDocumentWrong(): array
    {
        return [
            ["pdff", "1"],
            ["pdf", "100"]
        ];
    }

    public function testDownloadDatabase(): void
    {
        $this->markTestSkipped(
            "The text is skipped because testing goes through sqlite in memory, the dump of which could not be obtained, and I consider it superfluous to write in the working code getting a dump only because of the test."
        );
    }

    /**
     * @dataProvider providerDownloadPicturesSuccess
     */
    public function testDownloadPicturesSuccess(string $type): void
    {
        $this->seed();
        $this->seedStorage();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->get(route("download.pictures", [$type]));
        $response->assertDownload();
    }

    /**
     * @return mixed[]
     */
    public function providerDownloadPicturesSuccess(): array
    {
        return [
            ["zip"],
        ];
    }

    /**
     * @dataProvider providerDownloadPicturesSuccess
     */
    public function testDownloadPicturesEmpty(): void
    {
        $this->seed();
        $this->setConfigFakeDisk();
        $this->cleanStorage();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->get(route("download.pictures", ["zip"]));
        $response->assertStatus(200);
        $this->assertTrue(str_contains($response->getContent(), __("message.download.picture_missing")));
    }

    /**
     * @dataProvider providerDownloadPicturesWrong
     */
    public function testDownloadPicturesWrong(string $type): void
    {
        $this->seed();
        $this->seedStorage();
        $this->setConfigFakeDisk();

        $response = $this->actingAs($this->getAdmim())
            ->withSession(['banned' => false])
            ->get(route("download.pictures", [$type]));
        $response->assertStatus(404);
    }

    /**
     * @return mixed[]
     */
    public function providerDownloadPicturesWrong(): array
    {
        return [
            ["zzp"],
            ["pdf"]
        ];
    }
}
