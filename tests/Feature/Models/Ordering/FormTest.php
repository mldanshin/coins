<?php

namespace Tests\Feature\Models\Ordering;

use App\Models\ItemCollection;
use App\Models\Eloquent\Ordering;
use App\Models\Ordering\Form;
use App\Models\Ordering\Request;
use App\Models\LanguageType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @dataProvider providerCreate
     */
    public function testCreate(LanguageType $lang, int $value, ItemCollection $expected): void
    {
        $this->seed();

        $obj = new Form(Ordering::getPairCollection($lang), new Request($value));

        $this->assertInstanceof(Form::class, $obj);
        $this->assertEquals(new Request($value), $obj->value);
        $this->assertTrue($obj->parameters->contains($expected));
    }

    /**
     * @return mixed[]
     */
    public function providerCreate(): array
    {
        return [
            [LanguageType::ru, 1, new ItemCollection(2, "валюте и номиналу")],
            [LanguageType::en, 2, new ItemCollection(1, "year")]
        ];
    }
}
