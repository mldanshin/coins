<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request as BaseRequest;
use App\Models\Article;
use App\Models\Seo;
use App\Models\CRUD\Saving\Picture;
use App\Models\CRUD\Saving\Coin;
use App\Models\CRUD\Saving\Page;
use App\Models\Eloquent\CountryCurrency;
use Illuminate\Validation\Validator;

final class CreatorRequest extends BaseRequest
{
    /**
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
            "coin-country" => "required|numeric|exists:countries,id",
            "coin-nominal" => "required|numeric|exists:nominals,id",
            "coin-coinage" => "required|numeric|exists:coinages,id",
            "coin-material" => "required|numeric|exists:materials,id",
            "coin-currency" => "required|numeric|exists:currencies,id",
            "coin-shape" => "required|numeric|exists:shapes,id",
            "coin-theme" => "required|numeric|exists:themes,id",
            "coin-mintmark" => "nullable|numeric|exists:mintmarks,id",
            "coin-year" => "required|string|regex:/^[1-9][0-9]{3}$/",
            "coin-quality" => "required|numeric|exists:qualities,id",
            "coin-storage" => "required|numeric|exists:storages,id",

            "picture-obverse" => "nullable|string",
            "picture-reverse" => "nullable|string",

            "seo-title" => "nullable|required_with:seo-description|string|max:70",
            "seo-description" => "nullable|required_with:seo-keywords|string|max:320",
            "seo-keywords" => "nullable|required_with:seo-title|string|max:255",

            "article-title" => "nullable|required_with:article-content|string|max:100",
            "article-content" => "nullable|required_with:article-title|string",
        ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
            "seo-title.required_with" => __("validation.custom.seo.required_all_or_null"),
            "seo-description.required_with" => __("validation.custom.seo.required_all_or_null"),
            "seo-keywords.required_with" => __("validation.custom.seo.required_all_or_null"),
            "article-title.required_with" => __("validation.custom.article.required_all_or_null"),
            "article-content.required_with" => __("validation.custom.article.required_all_or_null"),
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $this->validateRelationCountryAndCurrency($validator);
    }

    private function validateRelationCountryAndCurrency(Validator $validator): void
    {
        $country = $this->input("coin-country");
        $currency = $this->input("coin-currency");

        if (!empty($country) && !empty($currency)) {
            $res = CountryCurrency::where("country_id", $country)->pluck("currency_id")->search($currency);
            if ($res === false) {
                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'coin-currency',
                        __("validation.custom.coin_currency.country_currency_not_relevant")
                    );
                });
            }
        }
    }

    public function getPage(): Page
    {
        return new Page(
            $this->getCoin(),
            $this->getPicture(),
            $this->getSeo(),
            $this->getArticle()
        );
    }

    public function getCoin(): Coin
    {
        return new Coin(
            $this->input("coin-country"),
            $this->input("coin-nominal"),
            $this->input("coin-coinage"),
            $this->input("coin-material"),
            $this->input("coin-currency"),
            $this->input("coin-shape"),
            $this->input("coin-theme"),
            $this->input("coin-mintmark"),
            $this->input("coin-year"),
            $this->input("coin-quality"),
            $this->input("coin-storage"),
        );
    }

    public function getPicture(): Picture
    {
        return new Picture(
            $this->input("picture-obverse"),
            $this->input("picture-reverse"),
        );
    }

    public function getSeo(): ?Seo
    {
        $title = $this->input("seo-title");
        $description = $this->input("seo-description");
        $keywords = $this->input("seo-keywords");

        if (empty($title) && empty($description) && empty($keywords)) {
            return null;
        } else {
            return new Seo(
                0,
                $title,
                $description,
                $keywords
            );
        }
    }

    public function getArticle(): ?Article
    {
        $title = $this->input("article-title");
        $content = $this->input("article-content");

        if (empty($title) && empty($content)) {
            return null;
        } else {
            return new Article(
                0,
                $title,
                $content
            );
        }
    }
}
