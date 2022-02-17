<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request as BaseRequest;
use App\Models\CRUD\CoinPreset;
use Illuminate\Validation\Validator;

final class PresetRequest extends BaseRequest
{
    /**
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
            "coin-country" => "nullable|numeric|exists:countries,id",
            "coin-nominal" => "nullable|numeric|exists:nominals,id",
            "coin-coinage" => "nullable|numeric|exists:coinages,id",
            "coin-material" => "nullable|numeric|exists:materials,id",
            "coin-currency" => "nullable|numeric|exists:currencies,id",
            "coin-shape" => "nullable|numeric|exists:shapes,id",
            "coin-theme" => "nullable|numeric|exists:themes,id",
            "coin-mintmark" => "nullable|numeric|exists:mintmarks,id",
            "coin-year" => "nullable|string|regex:/^[1-9][0-9]{3}$/",
            "coin-quality" => "nullable|numeric|exists:qualities,id",
            "coin-storage" => "nullable|numeric|exists:storages,id",
        ];
    }

    public function getCoinPreset(): CoinPreset
    {
        return new CoinPreset(
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
}
