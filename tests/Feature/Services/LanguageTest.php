<?php

namespace Tests\Feature\Services;

use App\Exceptions\PageNotFoundException;
use App\Models\LanguageType;
use App\Services\Language;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\DataProvider\Lang as LangDataProvider;

class LanguageTest extends TestCase
{
    use DatabaseMigrations;
    use LangDataProvider;

    public function testCreate(): Language
    {
        $obj = new Language();
        $this->assertInstanceOf(Language::class, $obj);
        return $obj;
    }

    /**
     * @depends testCreate
     * @dataProvider providerCurrent
     */
    public function testCurrent(
        callable $setCallbackLocale,
        LanguageType $expected,
        Language $language
    ): void {
        $this->seed();

        $setCallbackLocale();
        $this->assertEquals($expected, $language->current());
    }

    /**
     * @return mixed[]
     */
    public function providerCurrent(): array
    {
        return [
            [fn() => $this->setLangEn(), LanguageType::en]
        ];
    }

    /**
     * @depends testCreate
     * @dataProvider providerSetCurrent
     */
    public function testSetCurrent(
        string $langTwoLetter,
        Language $language
    ): void {
        $language->setCurrent($langTwoLetter);

        $this->assertEquals($this->getLang(), $langTwoLetter);
    }

    /**
     * @return mixed[]
     */
    public function providerSetCurrent(): array
    {
        return [
            ["ru"],
            ["en"],
        ];
    }

    /**
     * @depends testCreate
     * @dataProvider providerValidateSuccess
     */
    public function testValidateSuccess(
        string $lang,
        Language $language
    ): void {
        $this->assertTrue($language->validateLang($lang));
    }

    /**
     * @return mixed[]
     */
    public function providerValidateSuccess(): array
    {
        return [
            ["en"],
            ["ru"]
        ];
    }

    /**
     * @depends testCreate
     * @dataProvider providerValidateWrong
     */
    public function testValidateWrong(
        string $lang,
        Language $language
    ): void {
        try {
            $language->validateLang($lang);
        } catch (PageNotFoundException $e) {
            $this->assertInstanceOf(PageNotFoundException::class, $e);
        }
    }

    /**
     * @return mixed[]
     */
    public function providerValidateWrong(): array
    {
        return [
            ["en34"],
            ["ru23"]
        ];
    }

    /**
     * @depends testCreate
     */
    public function testGetSupported(Language $language): void
    {
        $array = $language->getSupported();
        $this->assertContains("ru", $array);
    }
}
