<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\BuilderQuery;
use App\Http\Requests\BuilderQueryContract;
use PHPUnit\Framework\TestCase;

class BuilderQueryTest extends TestCase
{
    public function testCreate(): void
    {
        $builderQuery = new BuilderQuery();
        $this->assertInstanceOf(BuilderQuery::class, $builderQuery);
        $this->assertEquals("", $builderQuery->getQuery());

        $builderQuery = new BuilderQuery(true);
        $this->assertEquals("", $builderQuery->getQuery());
    }

    /**
     * @dataProvider providerAddArrayString
     * @param string[] $value
     */
    public function testAddArrayString(
        bool $charQuestion,
        string $key,
        ?array $value,
        string $expected,
    ): void {
        $builderQuery = new BuilderQuery($charQuestion);
        $builderQuery->addArrayString($key, $value);
        
        $this->assertEquals($expected, $builderQuery->getQuery());
    }

    /**
     * @return mixed[]
     */
    public function providerAddArrayString(): array
    {
        return [
            [false, "countries", ["1", "12", "33"], "countries[]=1&countries[]=12&countries[]=33"],
            [false, "coin", ["14", "3"], "coin[]=14&coin[]=3"],
            [false, "coin", null, ""],
            [false, "coin", [], ""],
            [false, "", [], ""],
            [false, "", ["14"], ""],
            [true, "", [], ""],
            [true, "coin", ["15"], "?coin[]=15"],
        ];
    }

    /**
     * @dataProvider providerAddString
     */
    public function testAddString(
        bool $charQuestion,
        string $key,
        ?string $value,
        string $expected,
    ): void {
        $builderQuery = new BuilderQuery($charQuestion);
        $builderQuery->addString($key, $value);
        
        $this->assertEquals($expected, $builderQuery->getQuery());
    }

    /**
     * @return mixed[]
     */
    public function providerAddString(): array
    {
        return [
            [false, "countries", "12", "countries=12"],
            [false, "coin", "144", "coin=144"],
            [false, "coin", null, ""],
            [false, "", null, ""],
            [false, "", "15", ""],
            [true, "", "", ""],
            [true, "coin", "16", "?coin=16"]
        ];
    }

    /**
     * @dataProvider providerAddStringChain
     */
    public function testAddStringChain(
        string $key,
        ?string $value,
        string $expected,
        BuilderQuery $builderQuery
    ): void {
        $builderQuery->addString($key, $value);

        $this->assertEquals($expected, $builderQuery->getQuery());
    }

    /**
     * @return mixed[]
     */
    public function providerAddStringChain(): array
    {
        $builderQuery = new BuilderQuery();

        return [
            ["", "", "", $builderQuery],
            ["countries", "12", "countries=12", $builderQuery],
            ["coin", "144", "countries=12&coin=144", $builderQuery],
            ["coin", "88", "countries=12&coin=144&coin=88", $builderQuery],
            ["coin", null, "countries=12&coin=144&coin=88", $builderQuery],
            ["coin", "", "countries=12&coin=144&coin=88&coin=", $builderQuery],
            ["", "", "countries=12&coin=144&coin=88&coin=", $builderQuery]
        ];
    }

    /**
     * @dataProvider providerBuild
     */
    public function testBuild(
        bool $isComplete,
        string $expected,
        BuilderQueryContract ...$contracts
    ): void {
        $actual = BuilderQuery::build($isComplete, ...$contracts);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return mixed[]
     */
    public function providerBuild(): array
    {
        return [
            [false, "", $this->createMock(BuilderQueryContract::class)],
            [false, "", $this->createMock(BuilderQueryContract::class), $this->createMock(BuilderQueryContract::class)],
            [true, "", $this->createMock(BuilderQueryContract::class)]
        ];
    }
}
