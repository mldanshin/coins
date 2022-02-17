<?php

namespace Tests\Feature\Services;

use App\Models\LanguageType;
use App\Services\Provider;
use App\Services\FileStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\DataProvider\Lang as LangDataProvider;

class ProviderTest extends TestCase
{
    use DatabaseMigrations;
    use LangDataProvider;

    public function testCreate(): Provider
    {
        $obj = new Provider();
        $this->assertInstanceOf(Provider::class, $obj);
        return $obj;
    }

    /**
     * @depends testCreate
     */
    public function testGetLangCurrent(Provider $provider): void
    {
        $this->seed();

        $this->setLangEn();
        $actual = $provider->getLangCurrent();
        $this->assertEquals(LanguageType::en, $actual);

        $this->setLangRu();
        $actual = $provider->getLangCurrent();
        $this->assertNotEquals(LanguageType::ru, $actual);
    }

    /**
     * @depends testCreate
     */
    public function testGetStorage(Provider $provider): void
    {
        $actual = $provider->getStorage();
        $this->assertInstanceOf(FileStorage::class, $actual);
    }
}
