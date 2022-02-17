<?php

namespace Database\Factories\Eloquent;

use App\Models\Eloquent\Coin;
use App\Models\Eloquent\Coinage;
use App\Models\Eloquent\Country;
use App\Models\Eloquent\Material;
use App\Models\Eloquent\Nominal;
use App\Models\Eloquent\Quality;
use App\Models\Eloquent\Shape;
use App\Models\Eloquent\Storage;
use App\Models\Eloquent\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoinFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $country = Country::get()->random();
        $currency = $country->currencies()->get()->random();

        return [
            "country_id" => $country->id,
            "nominal_id" => Nominal::pluck("id")->random(),
            "coinage_id" => Coinage::pluck("id")->random(),
            "material_id" => Material::pluck("id")->random(),
            "currency_id" => $currency->id,
            "shape_id" => Shape::pluck("id")->random(),
            "theme_id" => Theme::pluck("id")->random(),
            "quality_id" => Quality::pluck("id")->random(),
            "storage_id" => Storage::pluck("id")->random(),
            "year" => $this->faker->year(),
        ];
    }
}
